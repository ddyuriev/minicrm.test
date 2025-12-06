<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function show()
    {
        return view('widget');
    }

    public function store(Request $request)
    {
        return response()->json(['message' => 'Request received']);
    }
}
