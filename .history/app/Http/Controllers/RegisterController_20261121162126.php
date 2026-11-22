<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
{
        $validated = $request->validate([
        'name'     => 'required|string|max:100',
        'email'    => 'required|email|max:255|unique:users,email',
        'password' => 'required|min:8|confirmed',
]);
}
}
