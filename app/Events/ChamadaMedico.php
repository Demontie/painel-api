<?php

namespace App\Events;

use App\Models\Painel\Atendimento;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChamadaMedico implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $atendimento;

    /**
     * ChamadaMedico constructor.
     * @param Atendimento $atendimento
     */
    public function __construct(Atendimento $atendimento)
    {
        $this->atendimento = $atendimento;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chamada-medico');
    }

    public function broadcastWith(){
        return $this->atendimento->toArray();
    }
}
