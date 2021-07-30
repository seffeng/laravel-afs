<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2021 seffeng
 */
namespace Seffeng\LaravelAfs\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @author zxf
 * @date   2021年7月30日
 * @method static \Seffeng\LaravelAfs\Afs loadClient(string $key)
 * @method static \Seffeng\LaravelAfs\Afs setScene(string $scene)
 * @method static \Seffeng\LaravelAfs\Afs setToken(string $token)
 * @method static \Seffeng\LaravelAfs\Afs setSig(string $sig)
 * @method static \Seffeng\LaravelAfs\Afs setSessionId(string $sessionId)
 * @method static \Seffeng\LaravelAfs\Afs setRemoteIp(string $ip)
 * @method static \Seffeng\LaravelAfs\Afs verify()
 *
 * @see \Seffeng\LaravelAfs\Afs
 */
class Afs extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'seffeng.laravel.afs';
    }
}
