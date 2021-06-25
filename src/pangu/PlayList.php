<?php

namespace DbPay\pangu;

/**
 * 歌单相关
 * Class PlayList
 * @package app\common\extend\kugou
 */
class PlayList extends Base
{
    /**
     * 推荐歌单
     * @param int $categoryId
     * @param int $page
     * @param int $size
     * @return array|bool
     */
    public function awesome(int $categoryId = 0, int $page=1, int $size=10)
    {
        $this->setAction('/api/resource/playlist/awesome');
        $this->setMethod('POST');
        $this->setPostParams(['page'=>(int)$page,'size'=>(int)$size,'category_id'=>(int)$categoryId]);
        $this->setTimeOut(50);
        if (!$this->request()) return false;
        $data['playlists'] = $this->getData();
        return $data;
    }

    /**
     * 歌单内歌曲列表
     * @param string $playlistId 歌单分类ID
     * @param int $page
     * @param int $size
     * @return array|bool
     */
    public function song($playlistId,$page=1,$size=10)
    {
        $this->setAction('/api/resource/playlist/song');
        $this->setPostParams([
            'playlist_id'=>(string)$playlistId, 'page'=>(int)$page,'size'=>(int)$size
        ]);
        $this->setMethod('POST');
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 歌单分类
     * @return array|bool
     */
    public function category()
    {
        $this->setAction('/api/resource/playlist/category');
        if (!$this->request()) return false;
        return $this->getData();
    }
}
