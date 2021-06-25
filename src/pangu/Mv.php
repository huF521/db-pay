<?php

namespace DbPay\pangu;

class Mv extends Base
{
    /**
     * MV导航下视频
     * @param $categoryId
     * @param $page
     * @param $size
     * @return bool|mixed
     */
    public function mvs($categoryId, $page = 1, $size = 10)
    {
        $this->setAction('/api/resource/mv/category/mvs');
        $this->setPostParams(['category_id'=>(string)$categoryId,'page'=>(int)$page,'size'=>(int)$size]);
        $this->setMethod('POST');
        if (!$this->request()) return false;
        return $this->getData();
    }

    public function getTmeLive($liveType, $page = 1, $size = 10)
    {
        $this->setAction('/api/resource/mv/getTmeLiveMv');
        $this->setPostParams(['live_type'=> (int)$liveType,'page'=>(int)$page,'size'=>(int)$size]);
        $this->setMethod('POST');
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * MV导航
     * @return bool|mixed
     */
    public function nav()
    {
        $this->setAction('/api/resource/mv/nav');
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * MV详情
     * @link http://api.dbkan.com/project/32/interface/api/3435
     * @param string $mvId
     * @return bool|mixed
     */
    public function detail(string $mvId)
    {
        $this->setAction('/api/resource/mv/detail');
        $this->setGetParams(['mv_id'=> $mvId]);
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * MV搜索
     * @param $keyword
     * @param int $page
     * @param int $size
     * @return array|false
     */
    public function search($keyword, int $page = 1, int $size = 10)
    {
        $this->setAction('/api/resource/search/mvdb');
        $this->setPostParams(['keyword'=> (string)$keyword, 'page'=>(int)$page, 'size' => (int)$size]);
        $this->setMethod('POST');
        if (!$this->request()) return false;
        return $this->getData();
    }
}
