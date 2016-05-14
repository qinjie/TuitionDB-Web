<?php

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'defaultController' => 'site',
    'name' => 'TuitionDB',
    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'),
        'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels'),
        'xupload' => realpath(__DIR__ . '/../extensions/xupload'),
        'Facebook' => realpath(__DIR__ . '/../extensions/Facebook'),
    ),
    // preloading 'log' component
    'preload' => array('log', 'boostrap'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.controllers.*',
        'application.components.*',
        'application.helpers.*',
        'bootstrap.helpers.*',
        'bootstrap.behaviors.*',
        'bootstrap.widgets.*',
        'ext.yii-mail.YiiMailMessage',
        'Facebook.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '1234',
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array('bootstrap.gii'),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            'class' => 'WebUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path if using ImageMagick
            'params' => array('directory' => '/opt/local/bin'),
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                'p/center/<nick:[\w\-]+>' => 'site/center',
                'p/tutor/<nick:\w+>' => 'site/tutor',

                'center/public/<nick:[\w\-]+>' => 'tuitionCenter/public',
                'tutor/public/<nick:\w+>' => 'tutor/public',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<id:\d+>/<title>' => '<controller>/view',
                '<controller:\w+>/<id:\d+>/<name>' => '<controller>/view',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
            ),
            'showScriptName' => false,
            'caseSensitive' => true,
        ),
          'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=tutorshub_dev',
            'emulatePrepare' => true,
            'username' => 'ftpdev',
            'password' => 'dev123ftp',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CEmailLogRoute',
                    'categories' => 'emailing',
                    'levels' => 'error',
                    'emails' => array('mark.qj@gmail.com'),
                    'sentFrom' => 'admin@tuitiondb.com',
                    'subject' => 'Error at TuitionDB.com',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error,warning',
                    'logFile' => 'log_EW.txt',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'info',
                    'logFile' => 'log_IN.txt',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'profile',
                    'logFile' => 'log_PF.txt',
                ),
                array(
                    'class' => 'CWebLogRoute',
                    'levels' => 'error, warning, info, trace',
                    'showInFireBug' => true,
                    'ignoreAjaxInFireBug' => true,
                    'enabled' => YII_DEBUG,
                ),
            ),
        ),
		'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
        'yiiwheels' => array(
            'class' => 'yiiwheels.YiiWheels',
        ),
        'session' => array(
            'autoStart' => true,
            'timeout' => 600,
        ),
        'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
            'transportType' => 'smtp',
            'transportOptions' => array(
                'host' => 'mail.privateemail.com',
                'port' => '465',
                'username' => 'admin@tuitiondb.com',
                'password' => 'Et@140123',
                'encryption' => 'ssl',
            ),
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false,
        ),
//        'cache' => array(
//            'class' => 'system.caching.CMemCache',
//        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'admin@tuitiondb.com',
        'uploadDir' => 'files/user/',
        'cookiesTimeout' => 3600 * 24 * 30, // 30 days
        'sendActivationMail' => true,
        'siteTitle' => 'TuitionDB - Tuition Database (Singapore)',
        'siteDescription' => 'Welcome to Singapore largest tuition database. TuitionDB provides free quality matching services between students and qualified tutors. It aims to be the largest premium tuition database in Singapore.',
        // for integration with Facebook page www.facebook.com/tuitiondb
        'facebook_app_id' => '311527579048444', // https://developers.facebook.com/apps/311527579048444/dashboard/
        'facebook_secret' => '71ac0d53e77e2bcb521cde91ac18d76b', // needed for the PHP SDK
        'facebook_page_id' => '254396334751619', // https://www.facebook.com/tuitiondb/info?tab=page_info
//        'facebook_app_token' => '311527579048444|YHqMTgpjWbebVaEVSc-dc2N9bdE',
//        'facebook_access_token' => 'CAAEbVSqv2fwBABLvZBsvmt6UTtdWxohxZCjZByDuEKrldPzzVeZCMDijIxuMZBZCuwjXRbSM1ZAwKOT7U3LBCt4KAfeAiamJ3Ss5d2ZCMTYRVuiuZChYgkYpV2ou2L9c2VSGQNfoFUyVPXL7xeJWZCQo03tpVQv047zZC4uTMReJTF6qnATKZCAkvdbcDoYfmsPCHFUBPPNTozPuSZCM2SCXuZC7WZB', // https://developers.facebook.com/tools/explorer/311527579048444/
    ),
);
