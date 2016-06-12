<?php

namespace V1\Controller;

use Application\Common\Controller\V1BaseController;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;

class PostController extends V1BaseController
{
    public function addAction()
    {
        $params = $this->params()->fromPost();
        //指定添加到数据库的默认字段类型
        $defaults = [
            'title' => '',
            'create_time' => date('Y-m-d H:i:s'),
            'content' => '',
            'thumbnail' => '',
            'author' => '',
            'typeid' => 0,
            'is_top' => 0,
            'tagids' => ''
        ];
        $new_params = $this->filterData($params, $defaults);
        $tBlog = $this->getTable('blog_post');
        try {
            $tBlog->insert($new_params);
            echo self::jsonEncode([1]);
            return false;
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
            error_log(
                $e->getMessage() . PHP_EOL .
                $e->getTraceAsString() . PHP_EOL
            );
            return self::echoJson('sql_error', $e->getMessage());
        }
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
        foreach ($params as $k => $v) {
            if ($k === 'title' && !empty($v)) {
                $where->like('title', '%' . $v . '%');
            }
        }
        try {
            $tBlog = $this->getTable('blog_post');
            $total_num = $tBlog->select(
                function (Select $select) use ($where) {
                    $select->columns(['total_num' => new Expression('count(id)')])
                        ->where($where);
                })->current()->offsetGet('total_num');
            $total_num = $total_num ?: '0';
            $posts = $tBlog->select(
                function (Select $select) use ($where, $offset, $rpp) {
                    $select->columns(['*'])
                        ->join(
                            ['a' => 'blog_cate'],
                            'a.id=blog_post.typeid',
                            ['cate_title' => 'title'],
                            $select::JOIN_LEFT
                        )->where($where)->order('id desc')->offset($offset)->limit($rpp);
                })->toArray();
            $data = [
                'data' => $posts,
                'total_num' => $total_num
            ];
            echo self::jsonEncode($data);
        } catch (\Exception $e) {
            error_log(
                $e->getMessage() . PHP_EOL .
                $e->getTraceAsString() . PHP_EOL
            );
            return self::echoJson('sql_error', $e->getMessage());
        }

        return false;
    }
}