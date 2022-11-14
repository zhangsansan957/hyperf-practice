<?php
/**
 * Date: 2022/11/3
 */

declare (strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Logger\LoggerFactory;

/**
 * 日志级别测试
 * @AutoController()
 * Class DbTestController
 */
class LogController extends AbstractController
{
    /**
     * 测试重写handler,严格level等级写入对应日志
     * @return bool
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function testLogLevelRecord()
    {
        $debugLogger = $this->container->get(LoggerFactory::class)->get('debug', 'debug');
        $infoLogger = $this->container->get(LoggerFactory::class)->get('info', 'info');
        $debugLogger->debug('debug');
        $debugLogger->info('info');
        $infoLogger->debug('debug');
        $infoLogger->info('info');

        return true;
    }
}