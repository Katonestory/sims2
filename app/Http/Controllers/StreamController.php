<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stream;

class StreamController extends Controller
{
    public function getStreams($classId)
    {
        $streams = Stream::where('class_id', $classId)->get(['id', 'name']);
        return response()->json($streams);
    }
}
