<?php

namespace V1\Controller;

use Application\Common\V1BaseController;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;

class BlogController extends V1BaseController
{
    public function addAction()
    {

    }

    public function editAction()
    {

    }

    public function listAction()
    {

        $params = $this->params()->fromPost();
        $rpp = array_key_exists('rpp', $params) ? (int)$params['rpp'] : 10;
        $page = array_key_exists('page', $params) ? (int)$params['page'] : 1;
        $rpp = $rpp > 0 ? $rpp : 10;
        $page = $page > 0 ? --$page : 0;
        $offset = $rpp * $page;
        $where = new Where();
        $tBlog = $this->getTable('blog_blog');
        $total_num = $tBlog->select(
            function (Select $select) use ($where) {
                $select->columns(['total_num' => new Expression('count(id)')])
                    ->where($where);
            })->current()->offsetGet('total_num');
        $total_num = $total_num ?: '0';
        $data = $tBlog->select(
            function (Select $select) use ($where, $offset, $rpp) {
                $select->columns(['*'])
                    ->join(
                        ['a' => 'blog_cate'],
                        'a.id=blog_blog.cate_id',
                        ['cate_title' => 'title'],
                        $select::JOIN_LEFT
                    )->where($where)->offset($offset)->limit($rpp);
            })->toArray();
        $data = [
            'data' => $data,
            'total_num' => $total_num
        ];
        echo self::jsonEncode($data);
        return false;
    }
}