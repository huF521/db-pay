<?php

namespace DbPay\pangu;

/**
 * 伴奏
 * Class Awesome
 * @package DbPay\pangu
 */
class Accompany extends Base
{
    /**
     * 伴奏分类详情
     * @link http://api.dbkan.com/project/32/interface/api/3381
     * @param $accompanyId
     * @return array|bool
     */
    public function info($accompanyId)
    {
        $this->action = "api/kugou/accompany/info/{$accompanyId}";
        if ($this->request()) {
            return $this->getData();
        }
        return false;
    }

    /**
     * 歌手列表
     * @link http://api.dbkan.com/project/32/interface/api/3411
     * @param string $area 歌手区域 1：华语 2：欧美 3：日韩
     * @param string $type 歌手类型 1：全部 2：男歌手 3：女歌手 4：组合
     * @return bool|mixed
     */
    public function singerList($area, $type)
    {
        $this->action = "api/kugou/accompany/singer/list";
        $this->getParams = [
            'area' => $area,
            'type' => $type,
        ];
        $this->timeOut = 30;
        if ($this->request()) {
            return $this->getData();
        }
        return false;
    }

    /**
     * 歌手伴奏
     * @link http://api.dbkan.com/project/32/interface/api/3411
     * @param string $singerId 歌手ID 3520 周杰伦
     * @param int $page
     * @param int $size
     * @return bool|mixed
     */
    public function singerSongs(string $singerId, int $page = 1, int $size = 10)
    {
        $this->action = "api/kugou/accompany/singer/songs/{$singerId}";
        $this->getParams = [
            'page' => $page,
            'size' => $size,
        ];
        if ($this->request()) {
            $result = $this->getData();
            $result['songs'] = $result['Data'] ?? [];
            unset($result['Data']);
            return $result;
        }
        return false;
    }

    /**
     * 伴奏分类列表 - 暂时无用
     * @link http://api.dbkan.com/project/32/interface/api/3411
     * @return bool|mixed
     */
    public function category()
    {
        $this->action = "api/kugou/accompany/category/list";
        if ($this->request()) {
            return $this->getData();
        }
        return false;
    }

    /**
     * 伴奏分类歌曲
     * @link http://api.dbkan.com/project/32/interface/api/3411
     * @param string $categoryId
     * @param int $page
     * @param int $size
     * @return bool|mixed
     */
    public function categorySong(string $categoryId, int $page = 1, int $size = 10)
    {
        $this->action = "api/kugou/accompany/category/{$categoryId}/song/";
        $this->getParams = ['page'=>$page,'size'=>$size];
        if (!$this->request()) {
            return false;
        }
        $result = $this->getData();
        $result['accompany'] = $result['data'] ?? [];
        unset($result['data']);
        return $result;
    }

    /**
     * 榜单列表 - 暂无使用
     * @link http://api.dbkan.com/project/32/interface/api/3459
     * @return bool|mixed
     */
    public function topList()
    {
        $this->action = "api/kugou/accompany/top/list";
        if (!$this->request()) {
            return false;
        }
        $result = $this->getData();
        $result['groups'] = $this->request();
        unset($result['data']);
        return $result;
    }

    /**
     * 榜单伴奏
     * @link http://api.dbkan.com/project/32/interface/api/3465
     * @param string $groupId
     * @param string|null $topId
     * @param int $page
     * @param int $size
     * @return bool|mixed
     */
    public function topSongs(string $groupId, string $topId = null, int $page=1, int $size=10)
    {
        $this->action = "api/kugou/accompany/top/songs";
        $this->getParams = [
            'group_id' => $groupId,
            'page' => $page,
            'size' => $size,
        ];
        if ($topId) $this->getParams['top_id'] = $topId;

        if (!$this->request()) {
            return false;
        }
        $result = $this->getData();
        $result['accompany'] = $result['data'] ?? [];
        unset($result['data']);
        return $result;
    }

    /**
     * 主题伴奏列表 - 暂无使用
     * @return array|bool
     */
    public function themeList()
    {
        $this->action = "api/kugou/accompany/theme/list";
        if (!$this->request()) {
            return false;
        }
        return $this->getData();
    }

    /**
     * 主题伴奏歌曲 - 暂无使用
     * @param $themeId
     * @param int $page
     * @param int $size
     * @return array|bool
     */
    public function themeSongs($themeId, int $page=1, int $size=10)
    {
        $this->action = "api/kugou/accompany/theme/{$themeId}/songs";
        $this->getParams = [
            'page' => $page,
            'size' => $size,
        ];
        if (!$this->request()) {
            return false;
        }
        return $this->getData();
    }

    /**
     * 伴奏推荐榜单
     * @param $type 1：热门榜 2:飙升榜
     * @param int $page
     * @param int $size
     * @return array|bool
     */
    public function awesomeTop($type, int $page=1, int $size=10)
    {
        $this->action = "api/kugou/accompany/awesome/top";
        $this->getParams = [
            'page' => (int)$page,
            'size' => (int)$size,
            'type' => (int)$type,
        ];
        if (!$this->request()) {
            return false;
        }
        $result = $this->getData();
        $result['accompany'] = $result['Data'] ?? [];
        unset($result['Data']);
        return $result;
    }

    /**
     * 伴奏榜单歌曲 - 免费
     * @param $groupId
     * @param $topId
     * @return array|bool
     */
    public function freeTopSongs($groupId, $topId = null)
    {
        $this->action = "api/kugou/accompany/free/top/songs";
        $this->getParams = [
            'top_id' => (string)$topId,
            'group_id' => (string)$groupId,
        ];
        if (!$this->request()) {
            return false;
        }
        $result = $this->getData();
        $result['accompany'] = $result['data'] ?? [];
        unset($result['data']);
        return $result;
    }

    /**
     * 伴奏榜单列表 - 免费 - 暂无使用
     * @return array|bool
     */
    public function freeTopList()
    {
        $this->action = "api/kugou/accompany/free/top/list";
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 伴奏个性化推荐
     * @param $userId
     * @param int $page
     * @param int $size
     * @return array|bool
     */
    public function personal($userId, $page = 1, $size = 10)
    {
        $this->action = "api/kugou/accompany/awesome/personal/{$userId}";
        $this->getParams = ['page'=>(int)$page,'size'=>(int)$size];
        if (!$this->request()) return false;
        $result = $this->getData();
        $result['accompany'] = $result['data'] ?? [];
        unset($result['data']);
        return $result;
    }

    /**
     * 伴奏搜索提示
     * @param $keyword
     * @return array|bool
     */
    public function searchTips($keyword)
    {
        $this->action = "api/kugou/accompany/search/tips";
        $this->getParams = ['keyword'=>(string)$keyword];
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 伴奏首字母搜索
     * @param $keyword
     * @return array|bool
     */
    public function newSearch($keyword)
    {
        $this->action = 'api/kugou/accompany/newsearch/song';
        $this->getParams = ['keyword'=>(string)$keyword];
        if (!$this->request()) return false;
        return $this->getData();
    }

    /**
     * 伴奏搜索
     * @param $keyword
     * @param int $page
     * @param int $size
     * @return array|bool
     */
    public function searchSong($keyword, $page = 1, $size = 10)
    {
        $this->action = 'api/kugou/accompany/search/song';
        $this->getParams = ['keyword'=>(string)$keyword,'page'=>(int)$page,'size'=>(int)$size];
        if (!$this->request()) return false;
        $result = $this->getData();
        $result['accompany'] = $result['data']['accompany'] ?? [];
        return $result;
    }
}
