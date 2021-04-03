<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;

class EventController extends Controller
{
    private $status_code = 200;
    private $error_code = 500;

    public function eventList() 
    {
        
        $events = Event::All();

        return response()->json($events, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
