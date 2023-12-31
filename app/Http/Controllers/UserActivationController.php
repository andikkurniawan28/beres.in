<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserActivationController extends Controller
{
    /**
     * Function to update user.is_activated field on User model.
     */
    public function __invoke($user_id)
    {
        $is_activated = User::whereId($user_id)->get()->last()->is_activated;
        if($is_activated === 0){
            User::whereId($user_id)->update(["is_activated" => 1]);
            return redirect()->back()->with("success", "User has been activated!");
        }
        elseif($is_activated === 1){
            User::whereId($user_id)->update(["is_activated" => 0]);
            return redirect()->back()->with("success", "User has been banned!");
        }
    }
}
