<?php
/**
 * Created by PhpStorm.
 * User: RikuTakenaka
 * Date: 2018/04/18
 * Time: 0:17
 */

//POSTリクエストの場合のみ受付
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //アクセストークン
    $access_token = "7099372798.b174b7a.f9abfd116966410fac4109adba977b11"; //取得したアクセストークンを設置
    //JSONデータを取得して出力
    echo @file_get_contents("https://api.instagram.com/v1/users/self/media/recent/?access_token={$access_token}");
    //終了
    exit;
}
