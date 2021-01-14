<?php
// Header 参数
/**
 *  @OA\SecurityScheme(
 *      securityScheme="Authorization",
 *      type="apiKey",
 *      in="header",
 *      name="Authorization",
 *      description="Token检验"
 * )
 */

// 请求参数
/**
 * 
 * @OA\Parameter(
 *      parameter="id",
 *      name="id",
 *      description="id",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="integer",
 *          format="int64",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="page",
 *      name="page",
 *      description="页数",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="integer",
 *          format="int64",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="count",
 *      name="count",
 *      description="条数",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="integer",
 *          format="int64",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="order_by",
 *      name="order_by",
 *      description="排序字段(默认:id)",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="string",
 *      )
 * )
 *
 * @OA\Parameter(
 *      parameter="start_time",
 *      name="start_time",
 *      description="开始时间戳",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="integer",
 *          format="int64",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="end_time",
 *      name="end_time",
 *      description="结束时间戳",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="integer",
 *          format="int64",
 *      )
 * )
 *
 * @OA\Parameter(
 *      parameter="version",
 *      name="version",
 *      description="版本(默认1.0.0)",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="string",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="device",
 *      name="device",
 *      description="设备(默认:android,ios)",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="string",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="version_type",
 *      name="version_type",
 *      description="设备类型(base,alpha,beta,默认:RC,release)",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="string",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="amount",
 *      name="amount",
 *      description="数量",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="integer",
 *          format="int64",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="number",
 *      name="number",
 *      description="数量",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="integer",
 *          format="int64",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="remark",
 *      name="remark",
 *      description="备注",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="string",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="keyword",
 *      name="keyword",
 *      description="关键词",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="string",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="type_id",
 *      name="type_id",
 *      description="账单类型ID",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="integer",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="number_min",
 *      name="number_min",
 *      description="最小数量",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="float",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="number_max",
 *      name="number_max",
 *      description="最大数量",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="float",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="area",
 *      name="area",
 *      description="区号",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="string",
 *      )
 * )
 * @OA\Parameter(
 *      parameter="phone_number",
 *      name="phone_number",
 *      description="手机号",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="integer",
 *      )
 * )
 * @OA\Parameter(
 *      parameter="email",
 *      name="email",
 *      description="邮箱",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="string",
 *      )
 * )
 * @OA\Parameter(
 *      parameter="account",
 *      name="account",
 *      description="账户",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="string",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="ticket",
 *      name="ticket",
 *      description="ticket",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="string",
 *      )
 * )
 * @OA\Parameter(
 *      parameter="randstr",
 *      name="randstr",
 *      description="randstr",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="string",
 *      )
 * )
 * 
 * @OA\Parameter(
 *      parameter="key",
 *      name="key",
 *      description="索引key",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="string",
 *      )
 * )
 */
