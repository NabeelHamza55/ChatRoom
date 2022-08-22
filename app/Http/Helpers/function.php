<?php

use App\Models\User;

function activeGuard(){
    foreach(array_keys(config('auth.guards')) as $guard){
        if(auth()->guard($guard)->check()) return $guard;
    }
    return null;
}
function getUserDetail($id){
    $user = User::find($id);
    if (empty($user)) {
        return 0;
    }else{
        return $user;
    }
}
