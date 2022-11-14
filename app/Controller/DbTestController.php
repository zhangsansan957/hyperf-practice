<?php
/**
 * Date: 2022/10/18
 */

declare (strict_types=1);

namespace App\Controller;


use Hyperf\DbConnection\Db;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController()
 * Class DbTestController
 * @package App\Controller
 */
class DbTestController extends AbstractController
{
    public function testDbEvent()
    {
        Db::table('goods')->first();
        Db::beginTransaction();
        try {
            Db::table('goods')->where('id', 1)->update([
                'number' => Db::raw('number + 1')
            ]);
            Db::commit();
        } catch (\Exception $e) {
            Db::rollBack();
        }

        return [
            'status' => 1
        ];
    }
}