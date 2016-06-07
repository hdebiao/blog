<?php

namespace V1\Controller;

use Application\Common\V1BaseController;

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
    }
}