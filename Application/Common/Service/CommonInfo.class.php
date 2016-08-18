<?php
namespace WeChatAPI\Service;

class commonInfo
{
  public function getClientIp() 
  {
    //PHP获取当前用户IP地址方法
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
      //check ip from share internet
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
      //to check ip is pass from proxy
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }

}

?>