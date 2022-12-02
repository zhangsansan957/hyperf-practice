<?php

declare(strict_types=1);

namespace App\Amqp\Producer;

use Hyperf\Amqp\Annotation\Producer;
use Hyperf\Amqp\Message\ProducerDelayedMessageTrait;
use Hyperf\Amqp\Message\ProducerMessage;
use Hyperf\Amqp\Message\Type;

/**
 * @Producer
 */
class DelayDirectProducer extends ProducerMessage
{
    use ProducerDelayedMessageTrait;

    protected $exchange = 'hyperf-2.2-delayed';

    protected $type = Type::DIRECT;

    protected $routingKey = 'delayed';

    public function __construct($data)
    {
        $this->payload = $data;
    }
}
