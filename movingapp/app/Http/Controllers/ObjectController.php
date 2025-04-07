<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\ObjectModel;
use Illuminate\Http\Request;


class ObjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objects = auth()->user()->objects()->with('box')->latest()->get();
        return view('objects.index', compact('objects'));
    }

    public function create()
    {
        $boxes = auth()->user()->boxes()->get();
        return view('objects.create', compact('boxes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'box_id' => 'required|exists:boxes,id',
            'name' => 'required|string|max:255',
            'weight' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'length' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
        ]);

        $box = Box::findOrFail($validated['box_id']);
        
        // Ellenőrizzük, hogy a felhasználó tulajdonosa-e a doboznak
        $this->authorize('update', $box);
        
        $validated['user_id'] = auth()->id();
        
        $object = Object::create($validated);
        
        // Ellenőrizzük, hogy a súly túllépte-e a határt
        if ($box->isOverweight()) {
            session()->flash('warning', 'Figyelem! A doboz súlya meghaladta a megadott határértéket!');
        }
        
        return redirect()->route('boxes.show', $box)->with('success', 'Tárgy sikeresen hozzáadva.');
    }

    public function show(Object $object)
    {
        $this->authorize('view', $object);
        
        return view('objects.show', compact('object'));
    }

    public function edit(Object $object)
    {
        $this->authorize('update', $object);
        
        $boxes = auth()->user()->boxes()->get();
        return view('objects.edit', compact('object', 'boxes'));
    }

    public function update(Request $request, Object $object)
    {
        $this->authorize('update', $object);

        $validated = $request->validate([
            'box_id' => 'required|exists:boxes,id',
            'name' => 'required|string|max:255',
            'weight' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'length' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
        ]);
        
        $object->update($validated);
        
        $box = Box::findOrFail($validated['box_id']);
        
        // Ellenőrizzük, hogy a súly túllépte-e a határt
        if ($box->isOverweight()) {
            session()->flash('warning', 'Figyelem! A doboz súlya meghaladta a megadott határértéket!');
        }
        
        return redirect()->route('objects.show', $object)->with('success', 'Tárgy sikeresen frissítve.');
    }

    public function destroy(Object $object)
    {
        $this->authorize('delete', $object);
        
        $boxId = $object->box_id;
        $object->delete();
        
        return redirect()->route('boxes.show', $boxId)->with('success', 'Tárgy sikeresen törölve.');
    }
}
