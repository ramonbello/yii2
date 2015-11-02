<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
   //'timeZone'=>'America/Ecuador',
    // available languages
    // 'ar','de','es','it','iw','ja','yi','zh-CN'
    'language' => 'es', // english
    'name'=>'Mi Blog',

    'components' => [

        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=blogcapa8',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],

                 'traduccion*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],

            ],
        ],
        /*
'urlManager' => [
            'class' => 'yii\web\UrlManager', //clase UrlManager
            'showScriptName' => false, //eliminar index.php
            'enablePrettyUrl' => true, //urls amigables
            'rules' => [
                'noticia/<slug>'   => 'site/noticia',
            ],
        ],
*/
  


    ],

    'modules' => [
   'gridview' =>  [
        'class' => '\kartik\grid\Module',
        // enter optional module parameters below - only if you need to  
        // use your own export download action or custom translation 
        // message source
       'downloadAction' => 'gridview/export/download',
       'i18n' => [
        'class' => 'yii\i18n\PhpMessageSource',
    'basePath' => '@kvgrid/messages',
    'forceTranslation' => true
    ],

    ]
],

];
