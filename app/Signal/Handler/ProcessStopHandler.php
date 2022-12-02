<?php
/**
 * Date: 2022/12/2
 */

declare (strict_types=1);

namespace App\Signal\Handler;


use Hyperf\Contract\ConfigInterface;
use Hyperf\Signal\SignalHandlerInterface;
use Psr\Container\ContainerInterface;
use Swoole\Server;

class ProcessStopHandler implements SignalHandlerInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var ConfigInterface
     */
    protected $config;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->config = $container->get(ConfigInterface::class);
    }

    public function listen(): array
    {
        return [
            [self::PROCESS, SIGTERM],
            [self::PROCESS, SIGINT],
        ];
    }

    public function handle(int $signal): void
    {
        if ($signal !== SIGINT) {
            $time = $this->config->get('server.settings.max_wait_time', 3);
            sleep($time);
        }

        $this->container->get(Server::class)->stop();
    }
}