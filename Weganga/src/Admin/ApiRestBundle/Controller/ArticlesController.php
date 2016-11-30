<?php

namespace Admin\ApiRestBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Decoder\JsonDecoder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticlesController extends Controller
{
    /**
     * Note: here the name is important
     * get => the action is restricted to GET HTTP method
     * Article => (without s) generate /articles/SOMETHING
     * Action => standard things for symfony for a controller method which
     *           generate an output
     *
     * it generates so the route GET .../articles/{id}
     */
    public function getArticleAction($id)
    {
        return array('hello' => 'world');
    }

    public function getArticlesAction()
    {
        return array('hello' => 'all');
    }
//    public function getArticleAction(){
//        return array('hello' => 'world','otro'=>'otro');
//    }

    public function postArticleAction(Request $request)
    {
        $decoder =  new JsonDecoder();
        return array("status" => "posted");
    }

    public function putArticleAction($id)
    {
        $decoder =  new JsonDecoder();
        return array("status" => 'updated');
    }

    public function deleteArticleAction($id)
    {
        $decoder =  new JsonDecoder();
        return array("status" => 'deleted');
    }
}
