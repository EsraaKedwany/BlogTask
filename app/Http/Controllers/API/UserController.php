<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function searchByName($name)
    {
        $users=User::where('name',$name)->get();
        if($users->first()==null)
        {
            return response()->json("no result", 404);
        }
        return response()->json($users, 200);
    }

    public function searchByEmail($email)
    {
        $user=User::where('email',$email)->first();
        if($user==null)
        {
            return response()->json("no result", 404);
        }
        return response()->json($user, 200);
    }

    public function follow($user)
    {
        $user=User::find($user);
        if($user==null)
        {
            return response()->json("wrong id", 404);
        }
        
    }
}
