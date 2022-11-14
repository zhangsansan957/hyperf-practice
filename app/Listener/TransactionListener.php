<?php
/**
 * Date: 2022/10/18
 */

declare (strict_types=1);

namespace App\Listener;


use Hyperf\Database\Events\QueryExecuted;
use Hyperf\Database\Events\TransactionBeginning;
use Hyperf\Database\Events\TransactionCommitted;
use Hyperf\Database\Events\TransactionRolledBack;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\Arr;
use Hyperf\Utils\Str;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * @Listener
 */
class TransactionListener implements ListenerInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->logger = $container->get(LoggerFactory::class)->get('sql');
    }

    public function listen(): array
    {
        return [
            TransactionBeginning::class,
            TransactionCommitted::class,
            TransactionRolledBack::class
        ];
    }

    /**
     * @param QueryExecuted $event
     */
    public function process(object $event)
    {
        if ($event instanceof TransactionBeginning) {
            var_dump('transaction beginning');
        } else if ($event instanceof  TransactionCommitted) {
            var_dump('transaction committed');
        } else if ($event instanceof  TransactionRolledBack) {
            var_dump('transaction rollback');
        }
    }
}