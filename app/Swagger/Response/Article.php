<?php
/**
 * @OA\Schema(
 *      schema="article",
 *      type="object",
 *      allOf={
 *          @OA\Schema(
 *              @OA\Property(property="status", description="状态", type="integer", default="200"),
 *              @OA\Property(property="msg", description="信息", type="string", default="操作成功"),
 *              @OA\Property(property="data", description="数据",ref="#/components/schemas/article_model")
 *          )
 *      }
 *  )
 */
/**
 * @OA\Schema(
 *      schema="articles",
 *      type="object",
 *      allOf={
 *          @OA\Schema(
 *              @OA\Property(property="status", description="状态", type="integer", default="200"),
 *              @OA\Property(property="msg", description="信息", type="string", default="操作成功"),
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  description="数据",
 *                  @OA\Items(ref="#/components/schemas/article_model"),
 *              ),
 *          )
 *      }
 *  )
 *
 */
/**
 * @OA\Schema(
 *      schema="article_model",
 *      @OA\Property(property="id", description="主键ID", type="integer", default="1"),
 *      @OA\Property(property="category_id", description="分类id", type="integer", default="0"),
 *      @OA\Property(property="title", description="文章标题", type="string", default=""),
 *      @OA\Property(property="description", description="文章描述", type="string", default=""),
 *      @OA\Property(property="cover", description="文章图片", type="string", default=""),
 *      @OA\Property(property="display", description="是否显示（0否 1是）", type="integer", default="1"),
 *      @OA\Property(property="keywords", description="关键字", type="string", default=""),
 *      @OA\Property(property="recommend", description="是否推荐（0否 1是）", type="integer", default="0"),
 *      @OA\Property(property="author", description="作者", type="string", default=""),
 *      @OA\Property(property="hits", description="阅读量", type="integer", default="0"),
 *      @OA\Property(property="type", description="文章类型（1不跳转 2文章详情 3应用页面跳转 4WebView链接 5浏览器链接）", type="integer", default="1"),
 *      @OA\Property(property="link", description="链接（不跳转和文章详情时为空）", type="string", default=""),
 *      @OA\Property(property="lang", description="语言", type="string", default=""),
 *      @OA\Property(property="video", description="视频", type="string", default=""),
 *      @OA\Property(property="content", description="文章内容", type="string", default=""),
 *      @OA\Property(property="created_at", description="创建时间", type="string", default="2020-01-01 0:0:0"),
 *      @OA\Property(property="updated_at", description="更新时间", type="string", default="2020-01-01 0:0:0")
 *  )
 */
