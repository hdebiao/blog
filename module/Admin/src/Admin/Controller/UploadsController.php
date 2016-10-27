<?php
namespace Admin\Controller;

use Base\Common\Controller\AdminBase;

/**
 * 文件上传模块
 * Class BlogController
 * @package Admin\Controller
 */
class UploadsController extends AdminBase
{
    public function indexAction()
    {
        echo sprintf('%s:%s', __FUNCTION__, __CLASS__);
        return false;
    }
}