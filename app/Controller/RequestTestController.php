<?php
/**
 * Date: 2022/11/9
 */

declare (strict_types=1);

namespace App\Controller;


use Hyperf\Context\Context;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Contract\RequestInterface;
use App\Middleware\FooMiddleware;

/**
 * 请求测试
 * @AutoController()
 * Class DbTestController
 */
class RequestTestController extends AbstractController
{
    /**
     * 修改请求包含的属性or请求头
     * @Middleware(FooMiddleware::class)
     * @param RequestInterface $request
     */
    public function testRequestAppend(RequestInterface $request)
    {
        var_dump('controller', $request);
        // $newRequest1 = Context::get(ServerRequestInterface::class);
        // var_dump($newRequest1->test, $newRequest1->getAttribute('test'), $newRequest1->getAttributes());

        // // 方法2
        // // 从协程上下文取出 $request 对象并设置 key 为 foo 的 Header，然后再保存到协程上下文中
        // Context::override(ServerRequestInterface::class, function (ServerRequestInterface $request) {
        //     return $request->withAttribute('test', 'test');
        // });
        // $request2 = Context::get(ServerRequestInterface::class);
        // var_dump($request2->getAttribute('test'));
    }
}