<?php  declare(strict_types=1);

namespace Seffeng\Afs\Tests;

use Seffeng\Afs\Exceptions\AfsException;
use PHPUnit\Framework\TestCase;
use Seffeng\LaravelAfs\Facades\Afs;

class AfsTest extends TestCase
{
    public function testVerify()
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