<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-06
 * Time: 08:39
 */

namespace App\Http;

use League\Fractal\Pagination\Cursor;
use League\Fractal\Resource\Collection;
use EllipseSynergie\ApiResponse\Laravel\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Item;

class ApiResponse extends Response
{
    public function withItemV1($data, $transformer, $resourceKey = null, $meta = [], array $headers = [])
    {
        $resource = new Item($data, $transformer, $resourceKey);

        foreach ($meta as $metaKey => $metaValue) {
            $resource->setMetaValue($metaKey, $metaValue);
        }

        $rootScope = $this->manager->createData($resource);
        $response = $rootScope->toArray();
        if($this->statusCode == '200'){
            $jsonData = [
                'status'    => 'T',
                'code'      => $this->getStatusCode(),
                'message'   => '',
                'data'      => $response['data'],
            ];
        }else{
            $jsonData = [
                'status'    => 'F',
                'code'      => $this->getStatusCode(),
                'message'   => '',
                'data'      => $response['data'],
            ];
        }
        return $this->withArray($jsonData, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function withCollection($data, $transformer, $resourceKey = null, Cursor $cursor = null, $meta = [], array $headers = []){
//         var_dump( get_class($data), $data->toArray());exit;
        $resource = new Collection($data, $transformer, $resourceKey);

        foreach ($meta as $metaKey => $metaValue) {
            $resource->setMetaValue($metaKey, $metaValue);
        }

        if (!is_null($cursor)) {
            $resource->setCursor($cursor);
        }

        $rootScope = $this->manager->createData($resource);

        $response = $rootScope->toArray();
        if($data instanceof LengthAwarePaginator){
            $response['pagination'] = [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
            ];
        }
        if($this->statusCode == '200'){
            $jsonData = [
                'status'    => 'T',
                'code'      => $this->getStatusCode(),
                'message'   => '',
                'data'      => $response['data'],
            ];
        }else{
            $jsonData = [
                'status'    => 'F',
                'code'      => $this->getStatusCode(),
                'message'   => '',
                'data'      => $response['data'],
            ];
        }
        return $this->withArray($jsonData, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function withCollectionDataLists($data, $transformer, $resourceKey = null, Cursor $cursor = null, $meta = [], array $headers = []){
        $resource = new Collection($data, $transformer, $resourceKey);
        foreach ($meta as $metaKey => $metaValue) {
            $resource->setMetaValue($metaKey, $metaValue);
        }
        if (!is_null($cursor)) {
            $resource->setCursor($cursor);
        }
        $rootScope = $this->manager->createData($resource);
        $responseData = $rootScope->toArray();
        $response = [];

        if($this->statusCode == '200'){
            $jsonData = [
                'status'    => 'T',
                'code'      => $this->getStatusCode(),
                'message'   => '',
                'data'      => $data,
            ];
        }else{
            $jsonData = [
                'status'    => 'F',
                'code'      => $this->getStatusCode(),
                'message'   => '',
                'data'      => $data,
            ];
        }

        if($data instanceof LengthAwarePaginator){
            $dataLists = [
                "pageTotal" => $data->lastPage(),
                "itemsTotal" => $data->total(),
                "page" => $data->currentPage(),
                "pageSize" => $data->perPage(),
                'lists' => $responseData['data'],
            ];
            $jsonData['data'] = array_merge($response, $dataLists);
        } else {
            $data = [];
            $jsonData['data']['lists'] =  $responseData['data'];
        }
        return $this->withArray($data, $headers);
    }
}