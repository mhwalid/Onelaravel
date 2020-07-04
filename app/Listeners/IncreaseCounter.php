<?php

namespace App\Listeners;

use App\Events\VideoViwer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */

    public function handle(VideoViwer $event)
    {
        if (!session()->has('videoIsvisited')) { // videoIsvisited it's a key
            $this->updateViewr($event->video);
        } else {
            return false;
        }
    }

    public function updateViewr($video)
    {
        $video->viewer += 1;
        $video->save();

        session()->put('videoIsvisited', $video->id);
    }
}
