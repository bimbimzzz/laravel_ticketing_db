<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {


        $categoryId = $request->category_id;

        $events = [];


        if ($categoryId == 'all') {
            $events = Event::all();
        } else {
            $events = Event::where('event_category_id', $categoryId)->get();
        }
        //load event_category and vendor
        $events->load('event_category', 'vendor');
        return response()->json([
            'status' => 'success',
            'message' => 'User logged out successfully',
            'data' => $events,
        ], 200);
    }

    public function categories()
    {
        $categories = EventCategory::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Event categories fetched successfully',
            'data' => $categories,
        ], 200);
    }

    //detail event and sku by event_id
    public function detail(Request $request)
    {
        $event = Event::with('skus')->find($request->event_id);
        $skus = $event->skus;
        return response()->json([
            'status' => 'success',
            'message' => 'Event detail fetched successfully',
            'data' => [
                'event' => $event,
            ],
        ], 200);
    }
}
