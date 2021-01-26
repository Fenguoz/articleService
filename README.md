<h1 align="center">文章服务</h1>

## 概述

文章服务是微服务就是一个独立的实体，它可以独立被部署，也可以作为一个操作系统进程存在。服务与服务之间存在隔离性，服务之间均通过网络调用进行通信，从而加强服务之间的隔离性，避免紧耦合。

该服务基于 Hyperf2.0 框架实现。通过 JSON RPC 轻量级的 RPC 协议标准，可自定义基于 HTTP 协议来传输，或直接基于 TCP 协议来传输方式实现服务注册。客户端只需要通过协议标准直接调用已封装好的方法即可。

适用范围：资讯、公告、新闻、帮助中心、用户协议、隐私协议、首页Bannner、广告、视频...

## 环境要求

- PHP >= 7.2
- Swoole PHP 扩展 >= 4.5，并关闭了 `Short Name`
- Mysql 5.7
- Nginx
- Consul

## 特点

- 自定义内置文章类型、文章分类类型
- 支持多语言文章
- 移动端多种打开方式
- 支持跨语言调用

## 功能清单

- 文章
    - 获取文章列表
    - 获取文章列表分页信息
    - 添加文章
    - 编辑文章
    - 删除文章
    - 获取文章详情(根据主键ID)
    - 获取文章详情(根据Key值)
    - 获取文章类型
- 文章分类
    - 获取文章分类列表
    - 获取文章分类列表分页信息
    - 添加文章分类
    - 编辑文章分类
    - 删除文章分类
    - 获取文章分类主键ID(根据key值)）
    - 获取文章分类类型

## 快速开始

### 部署

``` bash
# 克隆项目
git clone ...

# 进入根目录
cd {file}

# 安装扩展包
composer install

# 配置env文件
cp .env.example .env

# 数据迁移
php bin/hyperf.php migrate --seed

# 运行 Consul（若已运行，忽略）
consul agent -dev -bind 127.0.0.1

# 运行
php bin/hyperf.php start
```

### 接口调用

查看 **可调用接口** 详情，请查看 Swagger 文档。

访问路径：public/swagger/index.html

swagger文件：public/swagger/openapi.json

PHP 调用示例：
``` php
use GuzzleHttp\Client;

$host = 'http://127.0.0.1:9801';
(new Client)->post($host, [
    'json' => [
        'jsonrpc' => '2.0',
        'method' => '/article/getTypes',
        'params' => [],
        'id' => 1,
    ]
]);
```

CURL 调用示例：
``` bash
curl -X POST -H "Content-Type: application/json" \
--data '{"jsonrpc":"2.0","method":"/article/getTypes","params":[],"id":1}' \
http://127.0.0.1:9801
```

## 计划

- 批量处理
- 模型缓存
- ...

## 脚本命令
| 命令行 | 说明 | crontab |
| :-----| :---- | :---- |
| composer install | 安装扩展包 | -- |
| php bin/hyperf.php server:watch | 热更新（仅测试用） | -- |
| php bin/hyperf.php swagger:gen -o ./public/swagger/ -f json | 生成swagger文档 | -- |
