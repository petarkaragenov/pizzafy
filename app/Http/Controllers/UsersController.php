<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function update(Request $request) {
        $data = $request->validate([
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required'
        ]);

        User::findOrFail($request->id)->update($data);

        return response()->json(User::findOrFail($request->id));
    }

    public function destroy(Request $request) {
        User::findOrFail($request->id)->delete();

        return redirect('/');
    }
}
