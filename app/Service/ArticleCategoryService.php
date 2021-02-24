<?php

namespace App\Service;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Model\ArticleCategory;
use App\Model\ArticleCategoryType;
use App\Rpc\ArticleCategoryServiceInterface;
use Hyperf\RpcServer\Annotation\RpcService;
use OpenApi\Annotations\Get;
use OpenApi\Annotations\Parameter;
use OpenApi\Annotations\JsonContent;
use OpenApi\Annotations\Response;

/**
 * @RpcService(name="ArticleCategoryService", protocol="jsonrpc-http", server="jsonrpc-http", publishTo="consul")
 */
class ArticleCategoryService extends BaseService implements ArticleCategoryServiceInterface
{
    /**
     * @Get(
     *     path="/article_category/getList",
     *     operationId="getList",
     *     tags={"ArticleCategoryService"},
     *     summary="文章分类列表",
     *     description="文章分类列表",
     *     @Parameter(ref="#/components/parameters/category_where"),
     *     @Parameter(ref="#/components/parameters/category_order"),
     *     @Parameter(ref="#/components/parameters/count"),
     *     @Parameter(ref="#/components/parameters/page"),
     *     @Response(
     *         response=200,
     *         description="SUCCESS",
     *         @JsonContent(ref="#/components/schemas/article_category")
     *     ),
     *     @Response(
     *         response=10005,
     *         description="NO_DATA",
     *         @JsonContent(ref="#/components/schemas/no_data")
     *     )
     * )
     */
    public function getList(
        array $where = [],
        array $order = ['sort' => 'ASC', 'id' => 'DESC'],
        int $count = 0,
        int $page = 1
    ) {
        $list = (new ArticleCategory())->getList($where, $order, $count, $page);
        if (!$list)
            throw new BusinessException(ErrorCode::NO_DATA);

        return $this->success($list);
    }

    /**
     * @Get(
     *     path="/article_category/getPagesInfo",
     *     operationId="getPagesInfo",
     *     tags={"ArticleCategoryService"},
     *     summary="文章分类分页信息",
     *     description="文章分类分页信息",
     *     @Parameter(ref="#/components/parameters/category_where"),
     *     @Parameter(ref="#/components/parameters/count"),
     *     @Parameter(ref="#/components/parameters/page"),
     *     @Response(
     *         response=200,
     *         description="操作成功",
     *         @JsonContent(ref="#/components/schemas/pageInfo")
     *     )
     * )
     */
    public function getPagesInfo(array $where = [], int $count = 10, int $page = 1)
    {
        $pageInfo = (new ArticleCategory)->getPagesInfo($where, $count, $page);
        return $this->success($pageInfo);
    }

    /**
     * @Get(
     *     path="/article_category/add",
     *     operationId="add",
     *     tags={"ArticleCategoryService"},
     *     summary="添加文章分类",
     *     description="添加文章分类",
     *     @Parameter(ref="#/components/parameters/article_params"),
     *     @Response(
     *         response=200,
     *         description="操作成功",
     *         @JsonContent(ref="#/components/schemas/success")
     *     ),
     *     @Response(
     *         response=10001,
     *         description="ADD_FAIL",
     *         @JsonContent(ref="#/components/schemas/error")
     *     )
     * )
     */
    public function add(array $params)
    {
        $data = $this->_checkData($params);

        $result = ArticleCategory::create($data);
        if (!$result)
            throw new BusinessException(ErrorCode::ADD_FAIL);
        return $this->success();
    }

    /**
     * @Get(
     *     path="/article_category/edit",
     *     operationId="edit",
     *     tags={"ArticleCategoryService"},
     *     summary="编辑文章分类",
     *     description="编辑文章分类",
     *     @Parameter(ref="#/components/parameters/article_params"),
     *     @Response(
     *         response=200,
     *         description="操作成功",
     *         @JsonContent(ref="#/components/schemas/success")
     *     ),
     *     @Response(
     *         response=10003,
     *         description="UPDATE_FAIL",
     *         @JsonContent(ref="#/components/schemas/error")
     *     )
     * )
     */
    public function edit(array $params)
    {
        if (!isset($params['id']) || $params['id'] <= 0)
            throw new BusinessException(ErrorCode::IDS_EMPTY);
        $id = (int)$params['id'];

        $data = $this->_checkData($params);

        $result = ArticleCategory::where('id', $id)->update($data);
        if (!$result)
            throw new BusinessException(ErrorCode::UPDATE_FAIL);
        return $this->success();
    }

    /**
     * 校验数据
     * 
     * @param array $params
     * @return $data
     */
    private function _checkData($params = [])
    {
        $data = [];
        if (!isset($params['parent_id']) || $params['parent_id'] < 0)
            throw new BusinessException(ErrorCode::PARENT_ID_ERROR);
        if (!isset($params['name']) || empty($params['name']))
            throw new BusinessException(ErrorCode::NAME_EMPTY);

        $data['parent_id'] = (int)$params['parent_id'];
        $data['name'] = $params['name'];

        if (isset($params['key']) && $params['key']) $data['key'] = $params['key'];
        if (isset($params['display']) && $params['display']) $data['display'] = $params['display'];
        if (isset($params['sort']) && $params['sort']) $data['sort'] = $params['sort'];
        return $data;
    }

    /**
     * @Get(
     *     path="/article_category/delete",
     *     operationId="delete",
     *     tags={"ArticleCategoryService"},
     *     summary="删除文章分类",
     *     description="根据主键ID删除文章分类（支持批量）",
     *     @Parameter(ref="#/components/parameters/ids"),
     *     @Response(
     *         response=200,
     *         description="操作成功",
     *         @JsonContent(ref="#/components/schemas/success")
     *     ),
     *     @Response(
     *         response=10004,
     *         description="DELETE_FAIL",
     *         @JsonContent(ref="#/components/schemas/error")
     *     )
     * )
     */
    public function delete(string $ids)
    {
        if (!$ids)
            throw new BusinessException(ErrorCode::IDS_EMPTY);

        $idsArr = explode(',', $ids);
        $result = ArticleCategory::whereIn('id', $idsArr)->delete();
        if (!$result)
            throw new BusinessException(ErrorCode::DELETE_FAIL);

        return $this->success();
    }

    /**
     * @Get(
     *     path="/article_category/getIdByKey",
     *     operationId="getIdByKey",
     *     tags={"ArticleCategoryService"},
     *     summary="获取文章分类主键ID",
     *     description="根据key获取主键ID",
     *     @Parameter(ref="#/components/parameters/key"),
     *     @Response(
     *         response=200,
     *         description="操作成功",
     *         @JsonContent(ref="#/components/schemas/data")
     *     ),
     *     @Response(
     *         response=10002,
     *         description="DATA_NOT_EXIST",
     *         @JsonContent(ref="#/components/schemas/error")
     *     )
     * )
     */
    public function getIdByKey(string $key)
    {
        $id = ArticleCategory::where('key', $key)->value('id');
        if (!$id)
            throw new BusinessException(ErrorCode::DATA_NOT_EXIST);

        return $this->success($id);
    }

    /**
     * @Get(
     *     path="/article_category/getTypes",
     *     operationId="getTypes",
     *     tags={"ArticleCategoryService"},
     *     summary="获取文章分类类型",
     *     description="获取文章分类类型",
     *     @Response(
     *         response=200,
     *         description="操作成功",
     *         @JsonContent(ref="#/components/schemas/data")
     *     ),
     *     @Response(
     *         response=10005,
     *         description="NO_DATA",
     *         @JsonContent(ref="#/components/schemas/error")
     *     )
     * )
     */
    public function getTypes()
    {
        $types = ArticleCategoryType::pluck('name', 'key');
        if ($types->isEmpty())
            throw new BusinessException(ErrorCode::NO_DATA);

        return $this->success($types);
    }
}
