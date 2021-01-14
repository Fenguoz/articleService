<?php

// 请求参数
/**
 * 
 * @OA\Parameter(
 *      parameter="ids",
 *      name="ids",
 *      description="主键IDs",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="string",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="article_params",
 *      name="params",
 *      description="参数(category_id,title,key[,content|description|cover|display|recommend|sort|keywords|hits|author|type|link|lang|video])",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="object",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="article_where",
 *      name="where",
 *      description="where条件 例:{'category_id':1}",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="object",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="article_order",
 *      name="order",
 *      description="排序 例:{'hits':'DESC','id':'DESC'}",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="object",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="category_where",
 *      name="where",
 *      description="where条件 例:{'parent_id':0}",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="object",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="category_order",
 *      name="order",
 *      description="排序 例:{'sort':'DESC','id':'DESC'}",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="object",
 *      )
 * )
 */
