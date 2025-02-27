<?php

namespace App\Services;

use App\Models\BusinessAd;
use Illuminate\Support\Collection;

class AdService
{
    public function getHomePageAds(): Collection
    {
        $businessAAds = BusinessAd::where('business_id', 'A')
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        $otherAds = BusinessAd::where('business_id', '!=', 'A')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MIN(id)')
                    ->from('business_ads')
                    ->groupBy('business_id');
            })
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        return $businessAAds->merge($otherAds);
    }
}
