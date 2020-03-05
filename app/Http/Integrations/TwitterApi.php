<?php

namespace App\Http\Integrarions;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\User;

class TwitterApi
{
    private $access_token = '1235177379980627970-ppbo1aLvIO2ObCfv5WNJ9Wpv7XQ93e';
    private $acces_token_secret = 'AQok59obBgGRaTpn5F1e9ZdIyh9smwDQ8SWDzaL7qlAKo';
    private $consumer_key = 'kxVDVFbNDDG9Ef9Tbe6dGeQ8B';
    private $consumer_secret = 'xpvpi9Qy62rgFqfgzTRfgnbENHhDgyB8aXtWDX36C8DJVqho2f';

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