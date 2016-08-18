<?php
namespace Weixin\Controller;
use Think\Controller;
class NotifyController extends Controller {

    public $token;

    public function __construct(){
        parent::__construct();
        $this->token = C('WEIXIN.TOKEN');
    }

    public function valid()
    {
        $echoStr = I('request.echostr');
        if($this->checkSignature()){
            exit($echoStr);
        }
    }

    private function checkSignature()
    {
        $signature = I('request.signature');
        $timestamp = I('request.timestamp');
        $nonce = I('request.nonce');

        $tmpArr = array($this->token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
}