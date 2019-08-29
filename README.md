## 介绍

LuciferDingTalk 封装了钉钉第三方企业应用相关的接口。

## 环境要求

- PHP 7.0+
- [Composer](https://getcomposer.org/)

## 安装

```bash
composer require lucifer/dingtalk-third-enterprise:^1.0
```

## 使用

```php
use LuciferDingTalk\Application;

$config = [
            'corp_id' => 'your corp_id',
            'suite_key' => 'your suite_key',
            'suite_secret' => 'your suite_secret'
        ];

$app = new Application($config);

//获取企业凭证
$app->auth->getAccessToken($suiteTicket);

//第三方企业应用免登获取用户userid
$app->user->withAccessToken($accessToken)->getUserId($code);

//获取用户详情
$app->user->withAccessToken($accessToken)->get($userId);
```

## License

MIT
