<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendChat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $text;
    public $time;
    public $room;
    public $id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($textMessage, $timeMessage, $room, $id)
    {
        $this->text = $textMessage;
        $this->time = $timeMessage;
        $this->room = $room;
        $this->id = $id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat-'.$this->room);
    }

    public function broadcastAs()
    {
        return 'chat-request';
    }
}
