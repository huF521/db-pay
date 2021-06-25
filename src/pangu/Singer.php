<?php

namespace DbPay\pangu;

/**
 * 歌手相关
 * Class Singer
 * @package app\common\extend\kugou
 */
class Singer extends Base
{
    /**
     * 歌手列表
     * @param int $page 页码
     * @param int $size 每页数量
     * @param int $area 歌手地区：0:全部 1:内地 2:欧美 3:日本 4:韩国 5:港台 6:其它
     * @param int $type 歌手类型：0:全部 1:男 2:女 3:组合
     * @return array|bool
     */
    public function list(int $page = 1, int $size = 10, int $area = 0, int $type = 0)
    {
        $this->setAction('api/resource/singer/list');
        $this->setPostParams([
            'page' => (int)$page, 'size' => (int)$size,
            'area' => (int)$area, 'type' => (int)$type,
        ]);
        $this->setMethod('POST');
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 获取歌手信息
     * @param string $singerId 歌手ID
     * @return array|bool
     */
    public function info($singerId)
    {
        $this->setAction('api/resource/singer/info');
        $this->getParams = ['singer_id'=>(string)$singerId];
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 获取歌手歌曲列表
     * @param string $singerId 歌曲ID
     * @param int $page 页码
     * @param int $size 每页数量
     * @return array|bool
     */
    public function song($singerId, $page=1,$size=10)
    {
        $this->setAction('api/resource/singer/song');
        $this->postParams = [
            'page' => (int)$page, 'size' => (int)$size, 'singer_id' => (string)$singerId,
        ];
        $this->setMethod('POST');
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 歌手专辑
     * @param string $singerId 歌手ID
     * @param int $sort 排序 1：最热 2：最新
     * @param int $page 页码
     * @param int $size 每页数量
     * @return array|bool
     */
    public function album($singerId,$sort = 1,$page = 1,$size = 10)
    {
        $this->setAction('api/resource/singer/album');
        $this->setPostParams([
            'singer_id' => (string)$singerId, 'sort' => (int)$sort, 'page' => (int)$page, 'size' => (int)$size
        ]);
        $this->setMethod('POST');
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 专辑详情
     * @param $albumId
     * @param int $page
     * @param int $size
     * @return array|false
     */
    public function albumInfo($albumId, int $page = 1, int $size = 10)
    {
        $this->setAction('api/resource/album/info');
        $this->setPostParams([
            'album_id' => (string)$albumId, 'page' => $page, 'size' => $size
        ]);
        $this->setMethod('POST');
        if (!$this->request()) return false;
        return $this->getData();
    }
}
