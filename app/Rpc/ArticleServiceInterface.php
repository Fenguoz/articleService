<?php

namespace App\Rpc;

interface ArticleServiceInterface
{
    public function getList(array $where = [], array $order = [], int $count = 0, int $page = 1);

    public function getPagesInfo(array $where = [], int $count = 10, int $page = 1);

    public function add(array $params);

    public function edit(array $params);

    public function delete(string $ids);

    public function detail(int $id);

    public function detailByKey(string $key);

    public function getTypes();
}