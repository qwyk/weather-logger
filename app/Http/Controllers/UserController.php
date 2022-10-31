<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController
{
    public function show(Request $request) {
        return $request->user();
    }
}
