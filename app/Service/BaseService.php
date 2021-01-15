<?php

namespace App\Service;

use App\Constants\ErrorCode;
use Hyperf\Utils\ApplicationContext;
use OpenApi\Annotations\Info;
use OpenApi\Annotations\Server;

/**
 * @Info(
 *     version="1.0",
 *     title="Article｜Microservice",
 * ),
 * @Server(
 *     url="http://127.0.0.1:9801",
 *     description="本地"
 * )
 */
abstract class BaseService
{
    /**
     * @var ContainerInterfase
     */
    protected $container;

    public function __construct()
    {
        $this->container = ApplicationContext::getContainer();
    }

    /**
     * success
     */
    public function success($data = [], string $msg = null)
    {
        return [
            'code' => ErrorCode::SUCCESS,
            'message' => $msg ?? ErrorCode::getMessage(ErrorCode::SUCCESS),
            'data' => $data
        ];
    }

    /**
     * error
     */
    public function error(int $code = ErrorCode::ERROR, string $msg = null)
    {
        return [
            'code' => $code,
            'message' => $msg ?? ErrorCode::getMessage($code),
        ];
    }
}