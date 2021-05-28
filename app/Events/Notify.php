<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Notify implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $title;
    public $message;
    public $time;
    public $userType;
    public $userId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id,$title,$message,$time,$userType,$userId)
    {
        $this->id = $id;
        $this->title  = $title;
        $this->message  = $message;
        $this->time  = $time;
        $this->userType = $userType;
        $this->userId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['eon_health_notification'];
    }
}
