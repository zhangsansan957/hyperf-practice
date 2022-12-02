<?php

declare(strict_types=1);

namespace App\Command;

use App\Amqp\Producer\DelayDirectProducer;
use Hyperf\Amqp\Producer;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;
use Hyperf\Utils\ApplicationContext;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 * @Command
 */
class DelayCommand extends HyperfCommand
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct('test:delay_amqp');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Hyperf Demo Command');
    }

    public function handle()
    {
        $second = $this->input->getArgument('second') ?? 5;
        //1.delayed + direct
        $message = new DelayDirectProducer('delay+direct produceTime:'.date('Y-m-d H:i:s'));
        //2.delayed + fanout
        //$message = new DelayFanoutProducer('delay+fanout produceTime:'.(microtime(true)));
        //3.delayed + topic
        //$message = new DelayTopicProducer('delay+topic produceTime:' . (microtime(true)));
        $message->setDelayMs($second * 1000);
        $producer = $this->container->get(Producer::class);
        $producer->produce($message);
        $this->info('finished');

        return true;
    }

    protected function getArguments()
    {
        return [
            ['second', InputArgument::OPTIONAL, '秒数']
        ];
    }
}
