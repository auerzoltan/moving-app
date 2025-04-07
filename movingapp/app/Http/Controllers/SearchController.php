<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\ObjectModel;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('search.index');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('type', 'object');
        
        if (empty($query)) {
            return redirect()->route('search.index');
        }
        
        if ($type === 'object') {
            // Tárgy keresése
            $objects = Object::where('user_id', auth()->id())
                ->where('name', 'like', "%{$query}%")
                ->with('box')
                ->get();
            
            return view('search.results_objects', compact('objects', 'query'));
        } else {
            // Doboz keresése
            $boxes = Box::where('user_id', auth()->id())
                ->where('name', 'like', "%{$query}%")
                ->with('objects')
                ->get();
            
            return view('search.results_boxes', compact('boxes', 'query'));
        }
    }
}
