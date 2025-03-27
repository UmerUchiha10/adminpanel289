<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Event;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.events.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.events.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
            'type' => 'required|in:free,paid',
            'price' => 'required|integer|min:0',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'max_attendees' => 'required|integer|min:1',
        ]);
    
        try {
            Event::create($validatedData);
            return redirect()->route('events.index')->with('success', 'Event created successfully.');
        } catch (\Exception $e) {
         
            return redirect()
                ->back()
                ->withErrors('Something went wrong! Please try again. Error: ' . $e->getMessage());
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $event = Event::find($id);
        return view('admin.events.edit',compact('categories','event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
            'type' => 'required|in:free,paid',
            'price' => 'required|integer|min:0',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'max_attendees' => 'required|integer|min:1',
        ]);
    
        try {
            $event->update($validatedData);
            return redirect()->route('events.index')->with('success', 'Event updated successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors('Something went wrong! Please try again. Error: ' . $e->getMessage());
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $event = Event::findOrFail($id); // Find event or fail
            $event->delete(); // Delete the event
    
            return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors('Something went wrong! Please try again. Error: ' . $e->getMessage());
        }
    }
    
}
