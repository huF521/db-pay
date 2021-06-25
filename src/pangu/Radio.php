<?php

namespace DbPay\pangu;

class Radio extends Base
{
    /**
     * 电台导航
     * @link http://api.dbkan.com/project/32/interface/api/3393
     * @param array $params
     * @return bool|mixed
     */
    public function list(array $params = [])
    {
        $this->setAction('/api/resource/radio/list');
        $this->setMethod('POST');
        $this->setPostParams($params);
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 电台下歌曲
     * @param $radioId
     * @param int $page
     * @param int $size
     * @return array|bool
     */
    public function song($radioId, $page = 1, $size = 10)
    {
        $this->setAction('/api/resource/radio/song');
        $this->setPostParams([
            'page' => (int)$page,
            'size' => (int)$size,
            'radio_id' => (int)$radioId,
        ]);
        $this->setMethod('POST');
        if (!$this->request()) return false;
        return $this->getData();
    }
}
