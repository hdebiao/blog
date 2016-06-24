<?php
namespace Admin\Controller;

use Base\Common\Controller\AdminBase;
use Base\Common\Functions\Http;
/**
 * 博客文章模块
 * Class BlogController
 * @package Admin\Controller
 */
class PostController extends AdminBase
{
    public function indexAction()
    {
        echo sprintf('%s:%s', __FUNCTION__, __CLASS__);
        return false;
    }

    public function listAction()
    {
        $data = (array)json_decode(file_get_contents('php://input'), true);
        $url = $this->getApi() . '/post/list';
        echo Http::post($url, $data);
        return false;
    }

    public function addAction()
    {
        echo sprintf('%s:%s', __FUNCTION__, __CLASS__);
        return false;
    }

    public function editAction()
    {
        echo sprintf('%s:%s', __FUNCTION__, __CLASS__);
        return false;
    }

    public function deleteAction()
    {
        echo sprintf('%s:%s', __FUNCTION__, __CLASS__);
        return false;
    }
}