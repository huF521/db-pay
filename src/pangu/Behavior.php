<?php

namespace DbPay\pangu;

/**
 * 推送行为
 *
 * Class Behavior
 * @link http://api.dbkan.com/project/32/interface/api/3351
 * @package DbPay\pangu
 */
class Behavior extends Base
{
    /**
     * 用户播放行为
     * @param array $params
     * @return bool|mixed
     */
    public function play($params = [])
    {
        $this->setAction('api/play/create');
        $this->setPostParams($params);
        $this->setMethod('POST');
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 用户收藏
     * @param array $params
     * @return bool|mixed
     */
    public function collect($params = [])
    {
        $this->setAction('/api/collect/create');
        $this->setPostParams($params);
        $this->setMethod('POST');
        return $this->request();
    }

    /**
     * 用户取消收藏
     * @param array $params
     * @return bool|mixed
     */
    public function cancelCollect($params = [])
    {
        $this->setAction('/api/collect/remove');
        $this->setPostParams($params);
        $this->setMethod('POST');
        return $this->request();
    }

    /**
     * 用户搜索行为
     * @param array $params
     * @return bool|mixed
     */
    public function search($params = [])
    {
        $this->setAction('/api/search/create');
        $this->setPostParams($params);
        $this->setMethod('POST');
        return $this->request();
    }

    /**
     * 用户订购行为
     * @param array $params
     * @return bool|mixed
     */
    public function order($params = [])
    {
        $this->setAction('/api/order/create');
        $this->setPostParams($params);
        $this->setMethod('POST');
        return $this->request();
    }

    /**
     * 用户退购行为
     * @param array $params
     * @return bool|mixed
     */
    public function refund($params = [])
    {
        $this->setAction('/api/order/refund');
        $this->setPostParams($params);
        $this->setMethod('POST');
        return $this->request();
    }

    /**
     * 用户点击行为
     * @param array $params
     * @return bool|mixed
     */
    public function click(array $params = [])
    {
        $this->setAction('/api/click/create');
        $this->setPostParams($params);
        $this->setMethod('POST');
        return $this->request();
    }

    /**
     * 用户曝光行为
     * @param array $params
     * @return bool|mixed
     */
    public function display(array $params = [])
    {
        $this->setAction('/api/display/create');
        $this->setPostParams($params);
        $this->setMethod('POST');
        return $this->request();
    }
}
