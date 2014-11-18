<?php
// Define a path alias for the Bootstrap extension as it's used internally.
// In this example we assume that you unzipped the extension under protected/extensions.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'language' => 'ru',
    'name' => 'YBoard',
    'theme'=>'classic',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.admin.*',
        'application.modules.user.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.extensions.*',
        'application.extensions.yii-mail.*',
        'application.extensions.gallerymanager.*',
        'application.extensions.gallerymanager.models.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
//        'gii' => array(
//            'class' => 'system.gii.GiiModule',
//            'password' => 'qwerty',
//            // If removed, Gii defaults to localhost only. Edit carefully to taste.
//            'ipFilters' => array('127.0.0.1', '::1', '192.168.1.3'),
//        ),
        'user' => array(
            # encrypting method (php hash function)
            'hash' => 'md5',
            # send activation email
            'sendActivationMail' => true,
            # allow access for non-activated users
            'loginNotActiv' => false,
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
            # automatically login from registration
            'autoLogin' => true,
            # registration path
            'registrationUrl' => array('/user/registration'),
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
            # login form path
            'loginUrl' => array('/user/login'),
            # page after login
            'returnUrl' => array('/user/profile'),
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
        'admin',
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'class' => 'WebUser',
            'allowAutoLogin' => true,
            'loginUrl' => array('/user/login'),
        ),
        'cache'=>array(
           'class'=>'system.caching.CFileCache',
        ),
        'countBulletins'=>array('class'=>'CountBulletins'),
        'evenness'=>array('class'=>'Evenness'),
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
        'image'=>array(
            'class'=>'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver'=>'GD',
            // ImageMagick setup path
            //'params'=>array('directory'=>'D:/Program Files/ImageMagick-6.4.8-Q16'),
        ),
        'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
			'transportType' => 'php',
//            'transportType' => 'smtp',
//            'transportOptions' => array(
//                'host' => 'smtp.gmail.com',
//                'username' => 'username@gmail.com',
//                'password' => 'password',
//                'port' => '465',
//                'encryption'=>'tls',
//            ),
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false
        ),
        'config' => array(
           'class' => 'application.extensions.EConfig',
           'strictMode' => false,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '' => 'site/index',
                '<id:\d+>' => 'site/bulletin',
                'category/<id:\d+>' => 'site/category',
                'category/<action:\w+>/' => 'admin/category/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'db' => array(
            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
            'tablePrefix' => '',
//            'enableProfiling' => true,
//            'enableParamLogging' => true,
            'queryCacheID' => 'cache',
        ),
        // uncomment the following to use a MySQL database
        /*
          'db'=>array(
          'connectionString' => 'mysql:host=localhost;dbname=testdrive',
          'emulatePrepare' => true,
          'username' => 'root',
          'password' => '',
          'charset' => 'utf8',
          ),
         */
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
//                    'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
//                    'ipFilters'=>array('127.0.0.1','192.168.1.3'),
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);