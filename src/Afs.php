<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2021 seffeng
 */
namespace Seffeng\LaravelAfs;

use Seffeng\Afs\Helpers\ArrayHelper;
use Seffeng\Afs\Exceptions\AfsException;
use Seffeng\Afs\AfsClient;

/**
 *
 * @author zxf
 * @date   2021年7月30日
 *
 * @see Seffeng\Afs\AfsClient
 */
class Afs
{
    /**
     *
     * @var string
     */
    private $accessKeyId;

    /**
     *
     * @var string
     */
    private $accessKeySecret;

    /**
     *
     * @var string
     */
    private $appKey;

    /**
     *
     * @var string
     */
    private $token;

    /**
     *
     * @var string
     */
    private $sig;

    /**
     *
     * @var string
     */
    private $sessionId;

    /**
     *
     * @var string
     */
    private $scene;

    /**
     *
     * @var string
     */
    private $remoteIp;

    /**
     *
     * @var string
     */
    private $client;

    /**
     *
     * @var AfsClient
     */
    private $service;

    /**
     *
     * @var array
     */
    private static $config;

    /**
     *
     * @author zxf
     * @date   2021年7月30日
     * @param  array $config
     */
    public function __construct(array $config)
    {
        static::$config = $config;
        $client = ArrayHelper::getValue($config, 'client');
        $this->loadClient($client);
    }

    /**
     *
     * @author zxf
     * @date   2021年7月30日
     * @param string $client
     * @return static
     */
    public function loadClient(string $client)
    {
        $this->setClient($client);
        $this->loadConfig();
        return $this;
    }

    /**
     *
     * @author zxf
     * @date   2021年7月30日
     * @return static
     */
    protected function loadConfig()
    {
        $client = ArrayHelper::getValue(static::$config, 'clients.' . $this->getClient());
        if ($client) {
            $this->accessKeyId = ArrayHelper::getValue($client, 'accessKeyId');
            $this->accessKeySecret = ArrayHelper::getValue($client, 'accessKeySecret');
            $this->appKey = ArrayHelper::getValue($client, 'appKey');

            if (empty($this->getAccessKeyId()) || empty($this->getAccessKeySecret()) || empty($this->getAppKey())) {
                throw new AfsException('Warning: accessKeyId, accessKeySecret, appKey cannot be empty.');
            }
        } else {
            throw new AfsException('The client['. $this->getClient() .'] is not found.');
        }
        $this->service = new AfsClient($this->getAccessKeyId(), $this->getAccessKeySecret(), $this->getAppKey());
        $this->service->setDebug(ArrayHelper::getValue(static::$config, 'debug'));
        return $this;
    }

    /**
     *
     * @author zxf
     * @date   2021年7月30日
     * @return string
     */
    public function getAccessKeyId()
    {
        return $this->accessKeyId;
    }

    /**
     *
     * @author zxf
     * @date   2021年7月30日
     * @return string
     */
    public function getAccessKeySecret()
    {
        return $this->accessKeySecret;
    }

    /**
     *
     * @author zxf
     * @date   2021年7月30日
     * @return string
     */
    public function getAppKey()
    {
        return $this->appKey;
    }

    /**
     *
     * @author zxf
     * @date   2021年7月30日
     * @param  string $client
     * @return static
     */
    protected function setClient(string $client)
    {
        $this->client = $client;
    }

    /**
     *
     * @author zxf
     * @date   2021年7月30日
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     *
     * @author zxf
     * @date   2021年7月30日
     * @return AfsClient
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     *
     * @author zxf
     * @date   2021年7月30日
     * @param mixed $method
     * @param mixed $parameters
     * @throws AfsException
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (method_exists($this->getService(), $method)) {
            return $this->getService()->{$method}(...$parameters);
        } else {
            throw new AfsException('方法｛' . $method . '｝不存在！');
        }
    }
}
