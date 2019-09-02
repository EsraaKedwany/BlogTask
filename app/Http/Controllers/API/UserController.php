<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function searchByName($locale, $name)
    {
        $users=User::where('name',$name)->get();
        if($users->first()==null)
        {
            return response()->json(trans('messages.no_res'), 404);
        }
        return response()->json(UserResource::collection($users), 200);
    }

    public function searchByEmail($locale, $email)
    {
        $user=User::where('email',$email)->first();
        if($user==null)
        {
            return response()->json(trans('messages.no_res'), 404);
        }
        return response()->json(new UserResource ($user), 200);
    }

    public function follow($locale, $user)
    {
        $user=User::find($user);
        if($user==null)
        {
            return response()->json(trans('messages.wrong_id'), 404);
        }
        
        $follower=auth()->user();
        $flag=$user->followers()->attach($follower);

        return response()->json(trans('messages.follow'), 200);

    }
}
