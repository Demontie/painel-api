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

class SenhaGerada implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $senha;

    /**
     * SenhaGerada constructor.
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
        return new Channel('senha-gerada');
    }

    /**
     * @return array
     */
    public function broadcastWith(){
        $novaSenha = array_merge(
            $this->senha->toArray(),
            $this->senha->tipo_senha->toArray()
        );
        unset($novaSenha['tipo_senha']);

        return $novaSenha;
    }
}
