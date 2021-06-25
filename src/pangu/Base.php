<?php

namespace DbPay\pangu;

use DbPay\BaseServer;
use GuzzleHttp\Client;

class Base extends BaseServer
{
    private string $appKey;
    private string $appSecret;

    protected string $method = 'GET';
    protected string $domain = '';
    protected string $action = '';

    protected array $headers = [];
    protected float $timeOut = 10;

    protected string $error = '';

    protected int $code = 99;
    protected array $data = [];

    protected array $getParams = [];
    protected array $postParams = [];

    public function request(): bool
    {
        $this->getParams = array_merge($this->getParams,[
            'app_key' => $this->appKey,
            'nonce' => uniqid(),
            'timestamp' => time(),
        ]);
        ksort($this->getParams);
        $options = [
            'query' => $this->getParams
        ];
        if ($this->postParams) {
            $options['body'] = json_encode($this->postParams);
        }
        $this->headers['signature'] = $this->sign();
        try {
            $client = new Client([
                'base_uri' => $this->domain,
                'timeout' => $this->timeOut,
                'headers' => $this->headers,
            ]);
            $response = $client->request($this->method, $this->action, $options);
        } catch (\Throwable $e) {
            $this->setError($e->getMessage());
            return false;
        }
        if ($response->getStatusCode() != 200) {
            $this->setError('请求错误! code = '. $response->getStatusCode());
            return false;
        }
        $result = json_decode($response->getBody()->getContents(), true);
        if (isset($result['code']) && $result['code'] != 0) {
            $this->setError($result['message'] ?? '请求错误');
            return false;
        }
        if (isset($result['error_code']) && $result['error_code'] != 0) {
            $this->setError($result['message'] ?? '请求错误');
            return false;
        }
        $this->setData($result['data'] ?? []);
        $this->setCode($result['error_code'] ?? $result['code']);
        return true;
    }

    protected function sign(): string
    {
        $getParams = $this->getGetParams();
        $postParams = $this->getPostParams();
        $str = '';
        if ($getParams) {
            ksort($getParams);
            $str .= http_build_query($getParams);
        }
        if ($postParams) {
            ksort($postParams);
            $str .= json_encode($postParams);
        }
        return md5($str.$this->getAppSecret());
    }

    /**
     * @return string
     */
    public function getAppKey(): string
    {
        return $this->appKey;
    }

    /**
     * @param string $appKey
     */
    public function setAppKey(string $appKey): void
    {
        $this->appKey = $appKey;
    }

    /**
     * @return string
     */
    public function getAppSecret(): string
    {
        return $this->appSecret;
    }

    /**
     * @param string $appSecret
     */
    public function setAppSecret(string $appSecret): void
    {
        $this->appSecret = $appSecret;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     */
    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @return float|int
     */
    public function getTimeOut()
    {
        return $this->timeOut;
    }

    /**
     * @param float|int $timeOut
     */
    public function setTimeOut($timeOut): void
    {
        $this->timeOut = $timeOut;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @param string $error
     */
    public function setError(string $error): void
    {
        $this->error = $error;
    }

    /**
     * @return array
     */
    public function getGetParams(): array
    {
        return $this->getParams;
    }

    /**
     * @param array $getParams
     */
    public function setGetParams(array $getParams): void
    {
        $this->getParams = $getParams;
    }

    /**
     * @return array
     */
    public function getPostParams(): array
    {
        return $this->postParams;
    }

    /**
     * @param array $postParams
     */
    public function setPostParams(array $postParams): void
    {
        $this->postParams = $postParams;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }
}
