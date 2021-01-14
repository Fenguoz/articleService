<?php

namespace App\Service;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Model\Article;
use App\Model\ArticleType;
use App\Rpc\ArticleServiceInterface;
use Hyperf\RpcServer\Annotation\RpcService;
use Hyperf\HttpServer\Annotation\GetMapping;
use OpenApi\Annotations\Get;
use OpenApi\Annotations\Parameter;
use OpenApi\Annotations\JsonContent;
use OpenApi\Annotations\Response;

/**
 * @RpcService(name="ArticleService", protocol="jsonrpc-http", server="jsonrpc-http", publishTo="consul")
 */
class ArticleService extends BaseService implements ArticleServiceInterface
{
    /**
     * @Get(
     *     path="/getList",
     *     operationId="getList",
     *     tags={"文章"},
     *     summary="文章列表",
     *     description="文章列表",
     *     @Parameter(ref="#/components/parameters/article_where"),
     *     @Parameter(ref="#/components/parameters/article_order"),
     *     @Parameter(ref="#/components/parameters/count"),
     *     @Parameter(ref="#/components/parameters/page"),
     *     @Response(
     *         response=200,
     *         description="操作成功",
     *         @JsonContent(ref="#/components/schemas/articles")
     *     )
     * )
     */
    /**
     * @GetMapping(path="getList")
     */
    public function getList(
        array $where = [],
        array $order = ['recommend' => 'DESC', 'sort' => 'ASC', 'id' => 'DESC'],
        int $count = 0,
        int $page = 1
    ) {
        $list = (new Article)->getList($where, $order, $count, $page);
        if (!$list)
            throw new BusinessException(ErrorCode::NO_DATA);

        return $this->success($list);
    }

    /**
     * @Get(
     *     path="/getPagesInfo",
     *     operationId="getPagesInfo",
     *     tags={"文章"},
     *     summary="文章分页信息",
     *     description="文章分页信息",
     *     @Parameter(ref="#/components/parameters/article_where"),
     *     @Parameter(ref="#/components/parameters/count"),
     *     @Parameter(ref="#/components/parameters/page"),
     *     @Response(
     *         response=200,
     *         description="操作成功",
     *         @JsonContent(ref="#/components/schemas/pageInfo")
     *     )
     * )
     */
    /**
     * @GetMapping(path="getPagesInfo")
     */
    public function getPagesInfo(array $where = [], int $count = 10, int $page = 1)
    {
        $pageInfo = (new Article)->getPagesInfo($where, $count, $page);
        return $this->success($pageInfo);
    }

    /**
     * @Get(
     *     path="/add",
     *     operationId="add",
     *     tags={"文章"},
     *     summary="添加文章",
     *     description="添加文章",
     *     @Parameter(ref="#/components/parameters/article_params"),
     *     @Response(
     *         response=200,
     *         description="操作成功",
     *         @JsonContent(ref="#/components/schemas/success")
     *     )
     * )
     */
    /**
     * @GetMapping(path="add")
     */
    public function add(array $params)
    {
        $data = $this->_checkData($params);

        $result = Article::create($data);
        if (!$result)
            throw new BusinessException(ErrorCode::ADD_FAIL);
        return $this->success();
    }

    /**
     * @Get(
     *     path="/edit",
     *     operationId="edit",
     *     tags={"文章"},
     *     summary="编辑文章",
     *     description="编辑文章",
     *     @Parameter(ref="#/components/parameters/article_params"),
     *     @Response(
     *         response=200,
     *         description="操作成功",
     *         @JsonContent(ref="#/components/schemas/success")
     *     )
     * )
     */
    /**
     * @GetMapping(path="edit")
     */
    public function edit(array $params)
    {
        if (!isset($params['id']) || $params['id'] <= 0)
            throw new BusinessException(ErrorCode::IDS_EMPTY);
        $id = (int)$params['id'];

        $data = $this->_checkData($params);

        $result = Article::where('id', $id)->update($data);
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
        if (!isset($params['category_id']) || $params['category_id'] <= 0)
            throw new BusinessException(ErrorCode::CATEGORY_ID_RERROR);
        if (!isset($params['title']) || empty($params['title']))
            throw new BusinessException(ErrorCode::TITLE_EMPTY);

        $data['category_id'] = (int)$params['category_id'];
        $data['title'] = $params['title'];

        if (isset($params['key']) && $params['key']) $data['key'] = $params['key'];
        if (isset($params['content']) && $params['content']) $data['content'] = $params['content'];
        if (isset($params['description']) && $params['description']) $data['description'] = $params['description'];
        if (isset($params['cover']) && $params['cover']) $data['cover'] = $params['cover'];
        if (isset($params['display']) && $params['display']) $data['display'] = $params['display'];
        if (isset($params['recommend']) && $params['recommend']) $data['recommend'] = $params['recommend'];
        if (isset($params['sort']) && $params['sort']) $data['sort'] = $params['sort'];
        if (isset($params['keywords']) && $params['keywords']) $data['keywords'] = $params['keywords'];
        if (isset($params['hits']) && $params['hits']) $data['hits'] = $params['hits'];
        if (isset($params['author']) && $params['author']) $data['author'] = $params['author'];
        if (isset($params['type']) && $params['type']) $data['type'] = $params['type'];
        if (isset($params['link']) && $params['link']) $data['link'] = $params['link'];
        if (isset($params['lang']) && $params['lang']) $data['lang'] = $params['lang'];
        if (isset($params['video']) && $params['video']) $data['video'] = $params['video'];
        return $data;
    }

    /**
     * @Get(
     *     path="/delete",
     *     operationId="delete",
     *     tags={"文章"},
     *     summary="删除文章",
     *     description="根据主键ID删除文章（支持批量）",
     *     @Parameter(ref="#/components/parameters/ids"),
     *     @Response(
     *         response=200,
     *         description="操作成功",
     *         @JsonContent(ref="#/components/schemas/success")
     *     )
     * )
     */
    /**
     * @GetMapping(path="delete")
     */
    public function delete(string $ids)
    {
        if (!$ids)
            throw new BusinessException(ErrorCode::IDS_EMPTY);

        $idsArr = explode(',', $ids);
        $result = Article::whereIn('id', $idsArr)->delete();
        if (!$result)
            throw new BusinessException(ErrorCode::DELETE_FAIL);

        return $this->success();
    }

    /**
     * @Get(
     *     path="/detail",
     *     operationId="detail",
     *     tags={"文章"},
     *     summary="文章详情",
     *     description="根据文章主键ID获取详情",
     *     @Parameter(ref="#/components/parameters/id"),
     *     @Response(
     *         response=200,
     *         description="操作成功",
     *         @JsonContent(ref="#/components/schemas/article")
     *     )
     * )
     */
    /**
     * @GetMapping(path="detail")
     */
    public function detail(int $id)
    {
        $article = Article::find($id);
        if (!$article)
            throw new BusinessException(ErrorCode::DATA_NOT_EXIST);

        $article->hits += 1;
        $article->save();
        return $this->success($article);
    }

    /**
     * @Get(
     *     path="/detailByKey",
     *     operationId="detailByKey",
     *     tags={"文章"},
     *     summary="文章详情（key）",
     *     description="根据key获取文章详情",
     *     @Parameter(ref="#/components/parameters/key"),
     *     @Response(
     *         response=200,
     *         description="操作成功",
     *         @JsonContent(ref="#/components/schemas/data")
     *     )
     * )
     */
    /**
     * @GetMapping(path="detailByKey")
     */
    public function detailByKey(string $key)
    {
        $article = Article::where('key', $key)->first();
        if (!$article)
            throw new BusinessException(ErrorCode::DATA_NOT_EXIST);

        $article->hits += 1;
        $article->save();
        return $this->success($article);
    }

    /**
     * @Get(
     *     path="/getTypes",
     *     operationId="getTypes",
     *     tags={"文章"},
     *     summary="获取文章类型",
     *     description="获取文章类型",
     *     @Response(
     *         response=200,
     *         description="操作成功",
     *         @JsonContent(ref="#/components/schemas/data")
     *     )
     * )
     */
    /**
     * @GetMapping(path="getTypes")
     */
    public function getTypes()
    {
        $types = ArticleType::pluck('name', 'key');
        if ($types->isEmpty())
            throw new BusinessException(ErrorCode::NO_DATA);

        return $this->success($types);
    }
}
