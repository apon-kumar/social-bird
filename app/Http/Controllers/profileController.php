<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class profileController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function uploadAvatar(Request $request)
    {
        if($request->hasFile('avatar')){       
            $filename = $request->avatar->getclientOriginalName();
            $request->avatar->storeAs('avatars', $filename, 'public');
            auth()->user()->update(['avatar' => $filename]);

            return redirect()->back();
            
        }
    }
}
