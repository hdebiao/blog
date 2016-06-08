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
        $params = $this->params()->fromPost();
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
        $new_params = [];
        foreach ($defaults as $k => $v) {
            if (array_key_exists($k, $params)) {
                $new_params[$k] = $this->dataType($params[$k], $v);
            } else {
                $new_params[$k] = $v;
            }
        }
        $tBlog = $this->getTable('blog_blog');
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
        try {
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
                            'a.id=blog_blog.typeid',
                            ['cate_title' => 'title'],
                            $select::JOIN_LEFT
                        )->where($where)->offset($offset)->limit($rpp);
                })->toArray();
            $data = [
                'data' => $data,
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