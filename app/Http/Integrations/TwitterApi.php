<?php

namespace App\Http\Integrarions;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\User;

class TwitterApi
{
    /**
     * Number of posts from user
     */
    protected $count = 10;

    public function getTweets(string $name) :array
    {
        $twitter = new TwitterOAuth(env('TWITTER_CONSUMER_KEY'), env('TWITTER_CONSUMER_SECRET'), env('TWITTER_ACCESS_TOKEN'), env('TWITTER_ACCESS_TOKEN_KEY'));
    
        $response = [];

        $tweets = $twitter->get("statuses/user_timeline", ["count" => $this->count, 'trim_user' => true, "exclude_replies" => true, 'screen_name' => $name]);
        
        if (isset($tweets->errors)) {
            $response += ['error' => $tweets->errors[0]->message];
        } else {
            $response += $tweets;
        }
        
        return $response;
    }
}