<?php
/**
 * Date: 2022/12/2
 */

declare (strict_types=1);

namespace App\Process;


use Hyperf\Contract\ConfigInterface;
use Hyperf\Process\AbstractProcess;
use Hyperf\Process\Annotation\Process;
use Hyperf\Utils\ApplicationContext;

/**
 * @Process(name="foo_process")
 */
class FooProcess extends AbstractProcess
{
    public function handle(): void
    {
        var_dump('max_wait_time', ApplicationContext::getContainer()->get(ConfigInterface::class)->get('server.settings.max_wait_time'));
        $t1 = time();
        var_dump('loop start');
        while (1) {
            if (time() - $t1 >= 20) {
                break;
            }
        }
        var_dump('loop finished');
    }
}