<?php
/**
 * Date: 2022/10/18
 */

declare (strict_types=1);

namespace App\Controller;


use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Rpn\Calculator;

/**
 * 逆波兰表示法
 * @AutoController()
 * Class DbTestController
 */
class RpnController extends AbstractController
{
    public function calc()
    {
        $value = $this->request->input('value');
        $calculator = new Calculator();
        $expression = $calculator->toRPNExpression('4-2*(5+5)-' . $value); // 4 2 5 5 + * - 10 -
        $res = $calculator->calculate($expression);
        return $res;
    }
}