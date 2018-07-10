<?php 

namespace App\Handlers;

use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;


class SlugTranslateHandler
{
    public function translate($text)
    {
      //實例化http客戶端
      $http = new Client;

      //初始化配置信息
      $api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
      $appid = config('services.baidu_translate.appid');
      $key = config('services.baidu_translate.key');
      $salt = time();

      //如果沒有配置翻譯，自動使用拼音方案
      if(empty($appid) || empty($key)) {
        return $this->pinyin($text);
      }

      //根據文檔，生成sign
      //文檔：http://api.fanyi.baidu.com/api/trans/product/apidoc
      //appid + q + slat + key 的md5 值
      $sign = md5($appid. $text. $salt. $key);

      //構建請求參數
      $query = http_build_query([
        "q" => $text,
        "from" => "auto",
        "to" => "en",
        "appid" => $appid,
        "salt" => $salt,
        //隨機數
        "sign" => $sign,
        //簽名
      ]);

      //發送http get request
      $response = $http->get($api.$query);

      $result = json_decode($response->getBody(), true);

    //dd($result)
    //    array:3 [▼
    //   "from" => "zh"
    //   "to" => "en"
    //   "trans_result" => array:1 [▼
    //       0 => array:2 [▼
    //           "src" => "XSS 安全漏洞"
    //           "dst" => "XSS security vulnerability"
    //         ]
    //     ]
    // ]

  

      //嘗試獲取翻譯結果
      if (isset($result['trans_result'][0]['dst'])) {
        return str_slug($result['trans_result'][0]['dst']);
       } else {
        // 如果翻譯沒結果，就用拼音
        return $this->pinyin($text);
      }
    }

    public function pinyin($text)
    {
      return str_slug(app(Pinyin::class)->permalink($text));
    }
}