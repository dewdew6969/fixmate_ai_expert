<?php

namespace App\Services;

use App\Models\Device;
use App\Models\Rule;
use App\Models\Diagnosis;

class ExpertSystemService
{
    /**
     * Match user symptoms against the rules for a specific device using Forward Chaining.
     *
     * @param int $deviceId
     * @param array $userAnswers Associative array of symptom_id => boolean (true/false)
     * @return array Array of matched diagnoses with their confidence scores
     */
    public function matchRules($deviceId, array $userAnswers)
    {
        $device = Device::with(['rules.symptoms', 'rules.diagnosis'])->findOrFail($deviceId);
        $matches = [];

        foreach ($device->rules as $rule) {
            if (!$rule->is_active || !$rule->diagnosis->is_active) {
                continue;
            }

            $ruleSymptoms = $rule->symptoms;
            $totalConditions = $ruleSymptoms->count();
            
            if ($totalConditions === 0) continue;

            $matchCount = 0;
            $hasContradiction = false;

            foreach ($ruleSymptoms as $symptom) {
                $expectedAnswer = (bool) $symptom->pivot->expected_answer;
                $symptomId = $symptom->id;

                // If user didn't answer this symptom yet, we can't definitively match or reject
                // But for standard forward chaining, if an answer contradicts, we reject the rule.
                if (isset($userAnswers[$symptomId])) {
                    if ((bool) $userAnswers[$symptomId] === $expectedAnswer) {
                        $matchCount++;
                    } else {
                        // Contradiction found, this rule is invalid
                        $hasContradiction = true;
                        break;
                    }
                }
            }

            if (!$hasContradiction && $matchCount > 0) {
                // Calculate how much of the rule is satisfied
                $satisfactionRatio = $matchCount / $totalConditions;
                
                // Final confidence is base rule confidence multiplied by satisfaction ratio
                $calculatedConfidence = $rule->confidence * $satisfactionRatio;

                $matches[] = [
                    'rule_id' => $rule->id,
                    'diagnosis_id' => $rule->diagnosis_id,
                    'diagnosis' => $rule->diagnosis,
                    'calculated_confidence' => round($calculatedConfidence, 2),
                    'is_full_match' => ($matchCount === $totalConditions),
                ];
            }
        }

        // Sort by highest confidence
        usort($matches, function ($a, $b) {
            return $b['calculated_confidence'] <=> $a['calculated_confidence'];
        });

        return $matches;
    }

    /**
     * Get the next question to ask based on the current answers.
     * This helps narrow down the rules that are still valid.
     */
    public function getNextQuestion($deviceId, array $userAnswers)
    {
        $device = Device::with(['rules.symptoms.questions'])->findOrFail($deviceId);
        
        $potentialQuestions = [];

        foreach ($device->rules as $rule) {
            $hasContradiction = false;
            
            // Check if rule is still valid
            foreach ($rule->symptoms as $symptom) {
                if (isset($userAnswers[$symptom->id])) {
                    if ((bool) $userAnswers[$symptom->id] !== (bool) $symptom->pivot->expected_answer) {
                        $hasContradiction = true;
                        break;
                    }
                }
            }

            // If rule is still valid, collect unanswered symptoms' questions
            if (!$hasContradiction) {
                foreach ($rule->symptoms as $symptom) {
                    if (!isset($userAnswers[$symptom->id])) {
                        // We need to ask about this symptom
                        foreach ($symptom->questions as $question) {
                            if ($question->is_active) {
                                $potentialQuestions[$question->id] = $question;
                            }
                        }
                    }
                }
            }
        }

        // Return the first potential question (can be optimized to ask the most discriminative question)
        if (!empty($potentialQuestions)) {
            return reset($potentialQuestions);
        }

        return null; // No more questions to ask
    }
}
