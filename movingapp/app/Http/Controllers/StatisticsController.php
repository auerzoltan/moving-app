<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\ObjectModel;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        
        $totalBoxes = $user->boxes()->count();
        $totalObjects = $user->objects()->count();
        $totalWeight = $user->objects()->sum('weight');
        $heaviestBox = $user->boxes()
            ->withCount('objects')
            ->with('objects')
            ->get()
            ->map(function ($box) {
                $box->total_weight = $box->objects->sum('weight');
                return $box;
            })
            ->sortByDesc('total_weight')
            ->first();
        
        $mostItems = $user->boxes()
            ->withCount('objects')
            ->orderByDesc('objects_count')
            ->first();
            
        $statistics = [
            'totalBoxes' => $totalBoxes,
            'totalObjects' => $totalObjects,
            'totalWeight' => $totalWeight,
            'heaviestBox' => $heaviestBox,
            'mostItems' => $mostItems,
        ];
        
        return view('statistics.index', compact('statistics'));
    }
}
