<?php
/**
 * Date: 2022/10/25
 */

declare (strict_types=1);

namespace App\Controller;


use Hyperf\Elasticsearch\ClientBuilderFactory;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController()
 * Class DbTestController
 */
class EsController extends AbstractController
{
    public function testConnect()
    {
        $builder = $this->container->get(ClientBuilderFactory::class)->create();
        $client = $builder->setHosts(['http://172.16.82.11:9200'])->build();
        $info = $client->info();

        return $info;
    }
    
    public function testStore()
    {
        $params = [
            'index' => 'my_index',
            'body'  => [ 'testField' => 'abc']
        ];
        $builder = $this->container->get(ClientBuilderFactory::class)->create();
        $client = $builder->setHosts(['http://172.16.82.11:9200'])->build();
        try {
            $response = $client->index($params);
        } catch (\Exception $e) {
            // eg. network error like NoNodeAvailableException
        }

        return $response;
    }

    public function testSearch()
    {
        $params = [
            'index' => 'my_index',
            'body'  => [
                'query' => [
                    'match' => [
                        'testField' => 'abc'
                    ]
                ]
            ]
        ];
        $builder = $this->container->get(ClientBuilderFactory::class)->create();
        $client = $builder->setHosts(['http://172.16.82.11:9200'])->build();
        $response = $client->search($params);

        return $response;
    }
}