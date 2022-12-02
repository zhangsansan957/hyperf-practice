<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Utils\ApplicationContext;

class IndexController extends AbstractController
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }

    public function loopTest()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();
        var_dump('max_wait_time', ApplicationContext::getContainer()->get(ConfigInterface::class)->get('server.settings.max_wait_time'));
        $t1 = time();
        var_dump('loop start');
        while (1) {
            if (time() - $t1 >= 20) {
                break;
            }
        }
        var_dump('loop finished');
        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }
}
