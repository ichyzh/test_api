<?php

namespace App\Http\Integrarions;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\User;

class TwitterApi
{
    private $access_token = 'token';
    private $acces_token_secret = 'token-secret';
    private $consumer_key = 'key';
    private $consumer_secret = 'secret';

    /**
     * Number of posts from user
     */
    protected $count = 10;

    public function getTweets(string $name) :array
    {
        $twitter = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $this->access_token, $this->acces_token_secret);
        
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