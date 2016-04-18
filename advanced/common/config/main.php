<?php
return [
  'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
  'modules' => [
    'admin' => [ /*Module RBAC admin*/
      'class' => 'mdm\admin\Module',
      'layout' => 'left-menu',
     'mainLayout' => '@app/views/layouts/main.php', /*Использование главного Layout нашего проекта*/

/*      'controllerMap' => [   Проблема в USER-> findIdentity
        'assignment' => [
          'class' => 'mdm\admin\controllers\AssignmentController',
          'userClassName' => 'common\models\User',
          'idField' => 'user_id'
        ],
      ],*/
    ],
  ],
  'components' => [
    'authManager' => [ /*Module RBAC admin*/
      'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
    ],
    'cache' => [
      'class' => 'yii\caching\FileCache',
    ],
    /*Yii2 eauth (social network)*/
    'eauth' => [
      'class' => 'nodge\eauth\EAuth',
     /* 'tokenStorage' => [
        'class' => '@app\eauth\DatabaseTokenStorage',
      ],*/
      'popup' => true, // Use the popup window instead of redirecting.
      'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache' on production environments.
      'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
      'httpClient' => [
        // uncomment this to use streams in safe_mode
        //'useStreamsFallback' => true,
      ],
      'services' => [ // You can change the providers and their classes.
        'google' => [
          // register your app here: https://code.google.com/apis/console/
          'class' => 'nodge\eauth\services\GoogleOAuth2Service',
          'clientId' => '...',
          'clientSecret' => '...',
          'title' => 'Google',
        ],
        'twitter' => [
          // register your app here: https://dev.twitter.com/apps/new
          'class' => 'nodge\eauth\services\TwitterOAuth1Service',
          'key' => '...',
          'secret' => '...',
        ],
        'yandex' => [
          // register your app here: https://oauth.yandex.ru/client/my
          'class' => 'nodge\eauth\services\YandexOAuth2Service',
          'clientId' => '...',
          'clientSecret' => '...',
          'title' => 'Yandex',
        ],
        'facebook' => [
          // register your app here: https://developers.facebook.com/apps/
          'class' => 'nodge\eauth\services\FacebookOAuth2Service',
          'clientId' => '...',
          'clientSecret' => '...',
        ],
        'yahoo' => [
          'class' => 'nodge\eauth\services\YahooOpenIDService',
          //'realm' => '*.example.org', // your domain, can be with wildcard to authenticate on subdomains.
        ],
        'linkedin' => [
          // register your app here: https://www.linkedin.com/secure/developer
          'class' => 'nodge\eauth\services\LinkedinOAuth1Service',
          'key' => '...',
          'secret' => '...',
          'title' => 'LinkedIn (OAuth1)',
        ],
        'linkedin_oauth2' => [
          // register your app here: https://www.linkedin.com/secure/developer
          'class' => 'nodge\eauth\services\LinkedinOAuth2Service',
          'clientId' => '...',
          'clientSecret' => '...',
          'title' => 'LinkedIn (OAuth2)',
        ],
        'github' => [
          // register your app here: https://github.com/settings/applications
          'class' => 'nodge\eauth\services\GitHubOAuth2Service',
          'clientId' => '...',
          'clientSecret' => '...',
        ],
        'live' => [
          // register your app here: https://account.live.com/developers/applications/index
          'class' => 'nodge\eauth\services\LiveOAuth2Service',
          'clientId' => '...',
          'clientSecret' => '...',
        ],
        'steam' => [
          'class' => 'nodge\eauth\services\SteamOpenIDService',
          //'realm' => '*.example.org', // your domain, can be with wildcard to authenticate on subdomains.
          'apiKey' => '...', // Optional. You can get it here: https://steamcommunity.com/dev/apikey
        ],
        'instagram' => [
          // register your app here: https://instagram.com/developer/register/
          'class' => 'nodge\eauth\services\InstagramOAuth2Service',
          'clientId' => '...',
          'clientSecret' => '...',
        ],
        'vkontakte' => [
          // register your app here: https://vk.com/editapp?act=create&site=1
          'class' => 'nodge\eauth\services\VKontakteOAuth2Service',
          'clientId' => '5357814',
          'clientSecret' => 'vNVFCDSUP421h8YQylB9',
        ],
        'mailru' => [
          // register your app here: http://api.mail.ru/sites/my/add
          'class' => 'nodge\eauth\services\MailruOAuth2Service',
          'clientId' => '...',
          'clientSecret' => '...',
        ],
        'odnoklassniki' => [
          // register your app here: http://dev.odnoklassniki.ru/wiki/pages/viewpage.action?pageId=13992188
          // ... or here: http://www.odnoklassniki.ru/dk?st.cmd=appsInfoMyDevList&st._aid=Apps_Info_MyDev
          'class' => 'nodge\eauth\services\OdnoklassnikiOAuth2Service',
          'clientId' => '...',
          'clientSecret' => '...',
          'clientPublic' => '...',
          'title' => 'Odnoklas.',
        ],
      ],
    ],
    'i18n' => [
      'translations' => [
        'eauth' => [
          'class' => 'yii\i18n\PhpMessageSource',
          'basePath' => '@eauth/messages',
        ],
      ],
    ],

    // (optionally) you can configure pretty urls
    'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
        'login/<service:google|facebook|etc>' => 'site/login',
      ],
    ],

    // (optionally) you can configure logging
    'log' => [
      'targets' => [
        [
          'class' => 'yii\log\FileTarget',
          'logFile' => '@app/runtime/logs/eauth.log',
          'categories' => ['nodge\eauth\*'],
          'logVars' => [],
        ],
      ],
    ],
  ],

/*  'as access' => [
    'class' => 'mdm\admin\components\AccessControl',
    'allowActions' => [
      'user/delete',
    ]
  ]*/
  /*Module RBAC admin*/
/*  'as access' => [
    'class' => 'mdm\admin\components\AccessControl',
    'allowActions' => [
      'site/*',
      'admin/*',
      'some-controller/some-action',
      // The actions listed here will be allowed to everyone including guests.
      // So, 'admin/*' should not appear here in the production, of course.
      // But in the earlier stages of your development, you may probably want to
      // add a lot of actions here until you finally completed setting up rbac,
      // otherwise you may not even take a first step.
    ]
  ],*/

];
