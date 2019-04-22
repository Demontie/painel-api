<?php

namespace App\Events;

use App\Models\Painel\Senha;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SenhaChamada implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $senha;

    /**
     * SenhaChamada constructor.
     * @param Senha $senha
     */
    public function __construct(Senha $senha)
    {
        $this->senha = $senha;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('senha-chamada');
    }

    public function broadcastWith(){
        return $this->senha->toArray();
    }
}
