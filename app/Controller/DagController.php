<?php
/**
 * Date: 2022/11/1
 */

declare (strict_types=1);

namespace App\Controller;


use Hyperf\Dag\Dag;
use Hyperf\Dag\Vertex;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * 有向无环图任务编排库
 * @AutoController()
 */
class DagController extends AbstractController
{
    public function testDag()
    {
        $dag = new Dag();
        $a = Vertex::make(function() {sleep(1); echo "A\n";});
        $b = Vertex::make(function() {sleep(1); echo "B\n";});
        $c = Vertex::make(function() {sleep(1); echo "C\n";});
        $d = Vertex::make(function() {sleep(1); echo "D\n";});
        $e = Vertex::make(function() {sleep(1); echo "E\n";});
        $f = Vertex::make(function() {sleep(1); echo "F\n";});
        $g = Vertex::make(function() {sleep(1); echo "G\n";});
        $h = Vertex::make(function() {sleep(1); echo "H\n";});
        $i = Vertex::make(function() {sleep(1); echo "I\n";});
        $dag->addVertex($a)
            ->addVertex($b)
            ->addVertex($c)
            ->addVertex($d)
            ->addVertex($e)
            ->addVertex($f)
            ->addVertex($g)
            ->addVertex($h)
            ->addVertex($i)
            ->addEdge($a, $b)
            ->addEdge($a, $c)
            ->addEdge($a, $d)
            ->addEdge($b, $h)
            ->addEdge($b, $e)
            ->addEdge($b, $f)
            ->addEdge($c, $f)
            ->addEdge($c, $g)
            ->addEdge($d, $g)
            ->addEdge($h, $i)
            ->addEdge($e, $i)
            ->addEdge($f, $i)
            ->addEdge($g, $i);
        $dag->run();

        return [];
    }
}