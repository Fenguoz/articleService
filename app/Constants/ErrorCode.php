<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 * 自定义错误码规范如下：
 * 其他-公共，10***
 * 其他-授权，11***
 * 其他-消息，12***
 * 其他-文章，13***
 * 用户，2****
 * 商品，3****
 * 订单，4****
 * 钱包，5****
 * 钱包-币种，50***
 * 钱包-账单，51***
 * 钱包-支付，52***
 * 业务，6****
 */
/**
 * @Constants
 */
class ErrorCode extends AbstractConstants
{
    /**
     * @Message("SUCCESS")
     */
    const SUCCESS = 200;

    /**
     * @Message("ERROR")
     */
    const ERROR = 500;

    /**
     * @Message("FILE_NOT_FOUND")
     */
    const FILE_NOT_FOUND = 10000;

    /**
     * @Message("ADD_FAIL")
     */
    const ADD_FAIL = 10001;

    /**
     * @Message("DATA_NOT_EXIST")
     */
    const DATA_NOT_EXIST = 10002;

    /**
     * @Message("UPDATE_FAIL")
     */
    const UPDATE_FAIL = 10003;

    /**
     * @Message("DELETE_FAIL")
     */
    const DELETE_FAIL = 10004;

    /**
     * @Message("IDS_EMPTY")
     */
    const IDS_EMPTY = 13000;

}
