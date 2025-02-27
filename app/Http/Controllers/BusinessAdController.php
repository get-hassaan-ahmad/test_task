<?php

namespace App\Http\Controllers;

use App\Services\AdService;
use Illuminate\Http\Request;

class BusinessAdController extends Controller
{
    protected $adService;

    public function __construct(AdService $adService)
    {
        $this->adService = $adService;
    }

    public function showAds()
    {
        $ads = $this->adService->getHomePageAds();
        return response()->json($ads);
    }
}
