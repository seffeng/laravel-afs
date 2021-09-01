## Laravel AFS

### 安装

```shell
# 安装
$ composer require seffeng/laravel-afs
```

##### Laravel

```php
# 1、生成配置文件
$ php artisan vendor:publish --tag="afs"

# 2、修改配置文件 /config/afs.php 或在 /.env 文件中添加配置
AFS_DEBUG= #[true-不验证直接返回成功，其他-通过阿里云验证结果]
AFS_ACCESS_KEY_ID=
AFS_ACCESS_KEY_SECRET=
AFS_APPKEY=

```

##### lumen

```php
# 1、将以下代码段添加到 /bootstrap/app.php 文件中的 Providers 部分
$app->register(Seffeng\LaravelAfs\AfsServiceProvider::class);

# 2、参考扩展包内 config/afs.php 在 /.env 文件中添加配置
AFS_DEBUG= #[true-不验证直接返回成功，其他-通过阿里云验证结果]
AFS_ACCESS_KEY_ID=
AFS_ACCESS_KEY_SECRET=
AFS_APPKEY=

```

### 目录说明

```
├─config
│   afs.php
├─src
│  │  Afs.php
│  │  AfsServiceProvider.php
│  ├─Facades
│  │    Afs.php
└─tests
    AfsTest.php
```

### 示例

```php
/**
 * 参考 tests/AfsTest.php
 */

use Seffeng\LaravelAfs\Facades\Afs;
use Seffeng\Afs\Exceptions\AfsException;

class SiteController extends Controller
{
    public function index()
    {
        try {
            $ip = '192.168.1.100';      // 客户端IP
            $scene = 'ic_login';        // 使用场景标识，必填参数，可从前端获取 [ic_login, nc_activity_h5, ...]
            $token = '1627557...';      // 请求唯一标识，必填参数，从前端获取
            $sig = '05XqrtZ0Ea...';     // 签名串，必填参数，从前端获取
            $sessionId = '01sWbn...';   // 会话ID，必填参数，从前端获取

            // Afs::loadClient('client');   //当有多个客户端时，使用其他客户端
            Afs::setRemoteIp($ip);
            Afs::setScene($scene);
            Afs::setToken($token);
            Afs::setSig($sig);
            Afs::setSessionId($sessionId);
            var_dump(Afs::verify()); // 仅为true，其他情况抛出异常(AfsException)
        } catch (AfsException $e) {
            echo $e->getMessage();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
    
```

## 项目依赖

| 依赖        | 仓库地址                           | 备注 |
| :---------- | :--------------------------------- | :--- |
| seffeng/afs | https://github.com/seffeng/php-afs | 无   |

### 备注

1、测试脚本 tests/AfsTest.php 仅作为示例供参考；

2、暂只支持滑动验证和智能验证；不支持无痕验证。



