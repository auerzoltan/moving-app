<?php

namespace App\Http\Controllers;

use App\Models\Box;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $boxes = auth()->user()->boxes()->latest()->get();
        return view('boxes.index', compact('boxes'));
    }

    public function create()
    {
        return view('boxes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'max_weight' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'length' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
        ]);

        $validated['user_id'] = auth()->id();
        
        Box::create($validated);
        
        return redirect()->route('boxes.index')->with('success', 'Doboz sikeresen létrehozva.');
    }

    public function show(Box $box)
    {
        $this->authorize('view', $box);
        
        $objects = $box->objects()->latest()->get();
        return view('boxes.show', compact('box', 'objects'));
    }

    public function edit(Box $box)
    {
        $this->authorize('update', $box);
        
        return view('boxes.edit', compact('box'));
    }

    public function update(Request $request, Box $box)
    {
        $this->authorize('update', $box);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'max_weight' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'length' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
        ]);
        
        $box->update($validated);
        
        return redirect()->route('boxes.show', $box)->with('success', 'Doboz sikeresen frissítve.');
    }

    public function destroy(Box $box)
    {
        $this->authorize('delete', $box);
        
        $box->delete();
        
        return redirect()->route('boxes.index')->with('success', 'Doboz sikeresen törölve.');
    }
}