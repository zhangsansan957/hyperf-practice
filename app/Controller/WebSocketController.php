<?php
/**
 * Date: 2022/11/2
 */

declare (strict_types=1);

namespace App\Controller;


use Hyperf\SocketIOServer\Annotation\Event;
use Hyperf\SocketIOServer\Annotation\SocketIONamespace;
use Hyperf\SocketIOServer\BaseNamespace;
use Hyperf\SocketIOServer\Socket;
use Hyperf\Utils\Codec\Json;

/**
 * @SocketIONamespace("/")
 */
class WebSocketController extends BaseNamespace
{
    /**
     * @Event("event")
     * @param Socket $socket
     * @param string $data
     * @return string
     */
    public function onEvent(Socket $socket, $data)
    {
        // 应答
        return 'Event Received: ' . $data;
    }

    /**
     * @Event("join-room")
     * @param Socket $socket
     * @param string $data
     */
    public function onJoinRoom(Socket $socket, $data)
    {

        // 将当前用户加入房间
        $socket->join($data);
        // 向房间内其他用户推送（不含当前用户）
        $socket->to($data)->emit('event', $socket->getSid() . "has joined {$data}");
        // 向房间内所有人广播（含当前用户）
        $this->emit('event', 'There are ' . count($socket->getAdapter()->clients($data)) . " players in {$data}");
    }

    /**
     * @Event("say")
     * @param Socket $socket
     * @param string $data
     */
    public function onSay(Socket $socket, $data)
    {
        $data = Json::decode($data);
        $socket->to($data['room'])->emit('event', $socket->getSid() . " say: {$data['message']}");
    }
}