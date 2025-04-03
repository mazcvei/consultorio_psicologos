<?php

namespace App\Helpers;
use App\Models\User;
Class UsersHelper{

    public static function isAdmin($user_id){
        $user = User::with('rol')->find($user_id);
        return $user && $user->rol->rol == "Admin";
    }
    public static function isClient($user_id){
        $user = User::with('rol')->find($user_id);
        return $user && $user->rol->rol == "Cliente";
    }

    public static function isPsychologist($user_id){
        $user = User::with('rol')->find($user_id);
        return $user && $user->rol->rol == "Psicologo";
    }
  
}

?>