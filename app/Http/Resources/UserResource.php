<?php

namespace App\Http\Resources;

use App\Http\Integrarions\TwitterApi;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $twitter = new TwitterApi();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'tweets' => $twitter->getTweets($this->name)
          ];
    }
}
