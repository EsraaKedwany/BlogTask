<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tweet;
use App\Http\Requests\Tweets\StoreTweetRequest;
use App\UserFollowers;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTweetRequest $request)
    {
        // dd($request);
        $current_user=auth()->user();
        $tweet=Tweet::create([
            'user_id' => $current_user->id,
            'body' => $request->body,
        ]);
        return response()->json($tweet, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tweet $tweet)
    {
        $is_exist=Tweet::find($tweet->id);
        if($is_exist){
            $tweet->delete();
            return response()->json(null, 204);
        }
    }

    public function user_time_line()
    {
        // current user
        $current_user=auth()->user();
        
        //select user_id from user_followers where follower_id=current user
        $followed_users=UserFollowers::select('user_id')->where('follower_id',$current_user->id)->get();

        //tweets of followed users
        $followed_tweets=Tweet::whereIn('user_id',$followed_users)->paginate(10);
        
        return response()->json($followed_tweets,200);

    }
}
