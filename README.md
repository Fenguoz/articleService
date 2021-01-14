# 文章服务

#### 环境配置：

- PHP >= 7.2
- Swoole PHP 扩展 >= 4.5，并关闭了 `Short Name`
- OpenSSL PHP 扩展
- JSON PHP 扩展
- PDO PHP 扩展
- Redis PHP 扩展
- Protobuf PHP 扩展
- Mysql5.7
- Nginx
- Swagger3.0

# Swagger

- 访问地址：Nginx自行配置（地址：public/swagger/index.html）
- 更新命令：php bin/hyperf.php swagger:gen -o ./public/swagger/ -f json