<?php

namespace DbPay\pangu;

class Song extends Base
{
    /**
     * 批量查询歌曲信息
     * @param array $songIds 歌曲Id列表 311582553 311546786
     * @return array|bool
     */
    public function infos($songIds)
    {
        $this->setAction('/api/resource/song/infos');
        $this->postParams = ['songs_id'=>$songIds];
        $this->setMethod('POST');
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 榜单列表 - 暂时无用
     * @link http://api.dbkan.com/project/32/interface/api/3555
     * @return array|bool
     */
    public function topList()
    {
        $this->setAction('api/resource/top/list');
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 排行榜歌曲列表
     * @param $topId 46868
     * @param int $page
     * @param int $size
     * @return array|bool
     */
    public function topSong($topId,$page=1,$size=10)
    {
        $this->setAction('api/resource/top/song');
        $this->setPostParams(['top_id'=> (string)$topId,'page'=>(int)$page,'size'=>(int)$size]);
        $this->setMethod('POST');
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 歌词
     * @param string $songId
     * @return array|false
     */
    public function lyric(string $songId)
    {
        $this->setAction('api/resource/song/lyric');
        $this->setGetParams(['song_id'=>$songId]);
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 歌曲播放地址
     * @param $songId
     * @return array|false
     */
    public function url($songId)
    {
        $this->setAction('/api/resource/song/url');
        $this->setGetParams(['song_id'=> (string)$songId]);
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 搜索Tips
     * @param $keyword
     * @return array|false
     */
    public function searchTips($keyword)
    {
        $this->setAction('/api/resource/search/tips');
        $this->setGetParams(['keyword'=> (string)$keyword]);
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 搜索歌曲
     * @param $keyword
     * @param int $page
     * @param int $size
     * @return array|false
     */
    public function search($keyword, $page = 1, $size = 10)
    {
        $this->setAction('/api/resource/search/songdb');
        $this->setPostParams(['keyword'=> (string)$keyword, 'page'=>(int)$page, 'size' => (int)$size]);
        $this->setMethod('POST');
        $this->timeOut = 30;
        if (!$this->request()) return false;
        return $this->getData();
    }
}
