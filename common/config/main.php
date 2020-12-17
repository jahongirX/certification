<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru-RU',
    'bootstrap' => ['lang'],
    'components' => [
        'httpclient' => [
            'class' =>'understeam\httpclient\Client',
            'detectMimeType' => true, // automatically transform request to data according to response Content-Type header
            'requestOptions' => [
                // see guzzle request options documentation
            ],
            'requestHeaders' => [
                // specify global request headers (can be overrided with $options on making request)
            ],
        ],
        'html2pdf' => [
            'class' => 'yii2tech\html2pdf\Manager',
            'viewPath' => '@app/views/site',
            'converter' => [
                'class' => 'yii2tech\html2pdf\converters\Wkhtmltopdf',
                'defaultOptions' => [
                    'pageSize' => 'A4'
                ],
            ]
        ],
        'session' => [
            'class' => 'yii\web\Session'
        ],
        'lang' => [
            'class' => 'common\components\Language',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                "<controller>/<action>/<id:\w+>" => '<controller>/<action>',
                "<controller>/<action>/<id:\w+>/<cat:\w+>" => '<controller>/<action>',
                '<controller:(service-request-subject|comment)>/<action:(create|update|delete)>/<id:\d+>' => '<controller>/<action>',
            ]
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'main' => 'main.php',
                    ],
//                    //'sourceLanguage' => 'main',
//                    'enableCaching' => true,
//                    'cachingDuration' => 60,
//                    'cache' => 'cache',
//                    //'forceTranslation'=>true,
                ],
            ],
        ],
//        'i18n' => [
//            'translations' => [
//                'frontend*' => [
//                    'class' => 'yii\i18n\PhpMessageSource',
//                    'basePath' => '@common/messages',
//                ],
//                'backend*' => [
//                    'class' => 'yii\i18n\PhpMessageSource',
//                    'basePath' => '@common/messages',
//                ],
//            ],
//        ],
        'mail' => [
            'class'            => 'zyx\phpmailer\Mailer',
            'viewPath'         => '@common/mail',
            'useFileTransport' => false,
            'config'           => [
                'mailer'     => 'smtp',
                'host'       => 'smtp.yandex.com',
                'port'       => '587',
                'smtpsecure' => 'tls',
                'smtpauth'   => true,
                'username'   => 'forestry.uz@yandex.com',
                'password'   => 'forestry',
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
];
