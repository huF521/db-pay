<?php

namespace DbPay\pangu;

class User extends Base
{
    /**
     * 登录接口
     * @link http://api.dbkan.com/project/32/interface/api/3196
     * @param array $params
     * @return bool|mixed
     */
    public function login(array $params = [])
    {
        $this->setAction('api/user/login');
        $this->setMethod('POST');
        $this->setPostParams($params);
        if (!$this->request()) return false;
        return $this->getData();
    }
}
