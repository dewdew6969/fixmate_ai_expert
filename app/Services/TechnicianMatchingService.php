<?php

namespace App\Services;

use App\Models\Technician;
use Illuminate\Support\Facades\DB;

class TechnicianMatchingService
{
    /**
     * Find best matching technicians for a specific problem.
     *
     * @param string $categoryName E.g., 'AC', 'Laptop'
     * @param string $userLocation
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findMatches($categoryName, $userLocation = null)
    {
        $query = Technician::with('user')
            ->where('is_verified', true)
            ->where('is_available', true)
            ->where('status', 'verified');

        // Note: Specialization string matching can be enhanced to use relation if categorized strictly
        if ($categoryName) {
            $query->where('specialization', 'like', '%' . $categoryName . '%');
        }

        if ($userLocation) {
            // Very basic location matching, usually requires Geo coordinates for distance calc
            $query->where('service_area', 'like', '%' . $userLocation . '%');
        }

        // Rank by rating and experience
        return $query->orderBy('rating', 'desc')
                     ->orderBy('completed_jobs', 'desc')
                     ->orderBy('experience_years', 'desc')
                     ->take(10)
                     ->get();
    }
}
