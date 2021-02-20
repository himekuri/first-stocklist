<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;


class UsersController extends Controller
{
    public function autoLogin($token)
    {
        $user = User::where('secret_token', $token)->first();
        if(!$user){
            return redirect('/login');
        }
        
        \Auth::login($user);
        
        // FIXME: 買い出しリストに飛ばす
        return redirect()->route('lists.index');
        
    }
    
}
