<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $user, $message, $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $message, $request)
    {
        $this->user = $user;
        $this->message = $message;
        $this->request = $request;

        $this->user->image = $user->profile_pic;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $id = $this->request->customer_id == $this->message->sender_id ?
                     $this->request->designer_id :
                     $this->request->customer_id;

        return new PrivateChannel('chat.' . $id);
    }


    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'message.sent';
    }
}
