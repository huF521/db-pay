<?php

namespace DbPay\pangu;

/**
 * 推荐
 * Class Awesome
 * @package DbPay\pangu
 */
class Awesome extends Base
{
    /**
     * 每日推荐
     * @link http://api.dbkan.com/project/32/interface/api/3519
     * @return bool|mixed
     */
    public function everyday()
    {
        $this->action = '/api/resource/awesome/everyday';
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 推荐猜你喜欢
     * @link http://api.dbkan.com/project/32/interface/api/3513
     * @return bool|mixed
     */
    public function recommend()
    {
        $this->action = '/api/resource/awesome/recommend';
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 推荐新歌首发
     * @link http://api.dbkan.com/project/32/interface/api/3519
     * @param $topId
     * @param int $page
     * @param int $size
     * @return bool|mixed
     */
    public function newSong($topId, $page = 1, $size = 10)
    {
        $this->action = '/api/resource/awesome/newsong';
        $this->postParams = ['top_id'=> (int)$topId,'page'=>(int)$page, 'size'=>(int)$size];
        $this->method = 'POST';
        if (!$this->request()) return false;
        return $this->getData();
    }
}
