<?php
/**
 * @OA\Schema(
 *      schema="article_category",
 *      type="object",
 *      allOf={
 *          @OA\Schema(
 *              @OA\Property(property="status", description="状态", type="integer", default="200"),
 *              @OA\Property(property="msg", description="信息", type="string", default="操作成功"),
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  description="数据",
 *                  @OA\Items(ref="#/components/schemas/article_category_model"),
 *              ),
 *          )
 *      }
 *  )
 *
 */
/**
 * @OA\Schema(
 *      schema="article_category_model",
 *      @OA\Property(property="id", description="主键ID", type="integer", default="1"),
 *      @OA\Property(property="name", description="名称", type="string", default=""),
 *      @OA\Property(property="parent_id", description="夫ID", type="integer", default="0"),
 *      @OA\Property(property="key", description="key", type="string", default=""),
 *      @OA\Property(property="display", description="是否显示（0否 1是）", type="integer", default="1"),
 *      @OA\Property(property="sort", description="排序", type="integer", default="100"),
 *  )
 */
