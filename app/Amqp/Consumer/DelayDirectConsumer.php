<?php

declare(strict_types=1);

namespace App\Amqp\Consumer;

use Hyperf\Amqp\Message\ConsumerDelayedMessageTrait;
use Hyperf\Amqp\Message\ProducerDelayedMessageTrait;
use Hyperf\Amqp\Message\Type;
use Hyperf\Amqp\Result;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * @Consumer(nums=1)
 */
class DelayDirectConsumer extends ConsumerMessage
{
    use ProducerDelayedMessageTrait;
    use ConsumerDelayedMessageTrait;

    protected $exchange = 'hyperf-2.2-delayed';

    protected $queue = 'hyperf-2.2-delayed';

    protected $type = Type::DIRECT; //Type::FANOUT;

    protected $routingKey = 'delayed';

    public function consumeMessage($data, AMQPMessage $message): string
    {
        var_dump($data, 'delay+direct consumeTime:' . date('Y-m-d H:i:s'));
        return Result::ACK;
    }
}
