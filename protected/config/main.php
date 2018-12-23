<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'OnPoint',
	'theme' => 'standard',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
              'application.modules.user.models.*',
        'application.modules.message.models.*',
	   'application.modules.user.components.*',
		'application.extensions.RJGFormErrors.RJGFormErrors',
        'application.extensions.yii-mail.YiiMailMessage',
		'application.models.*',
		'application.components.*',
                'application.modules.rights.*',
                'application.modules.rights.components.*',
	),


	'modules'=>array(
        'sites',
        'user'=>array(
                    # encrypting method (php hash function)
                    'hash' => 'md5',
         
                    # send activation email
                    'sendActivationMail' => false,
         
                    # allow access for non-activated users
                    'loginNotActiv' => false,
         
                    # activate user on registration (only sendActivationMail = false)
                    'activeAfterRegister' =>true,
         
                    # automatically login from registration
                    'autoLogin' => true,
         
                    # registration path
                    'registrationUrl' => array('/user/registration'),
         
                    # recovery password path
                    'recoveryUrl' => array('/user/recovery'),
         
                    # login form path
                    'loginUrl' => array('/user/login'),
         
                    # page after login
                    'returnUrl' => array('/patient/menu'),
         
                    # page after logout
                    'returnLogoutUrl' => array('/user/login'),
                    
                ),
		 'rights'=>array(
                    'install'=>false,
                ),
               'message' => array(
                        'userModel' => 'User',
                        'getNameMethod' => 'getFullName',
                        'getSuggestMethod' => 'getSuggest',
                        'viewPath' => '/message/fancy',
                ),
                
		// uncomment the following to enable the Gii tool
		'gii' => array(
		'class' => 'system.gii.GiiModule',
            'password'=>'123',

		'generatorPaths' => array(
			'ext.gtc', // giix generators
		),

	),
		
		
	),

	// application components
	'components'=>array(
        'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
            'transportType' => 'php',
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false
        ),

		'user'=>array(
		 'class'=>'RWebUser',
			// enable cookie-based authentication
                'loginUrl' => array('/user/login'),
			'allowAutoLogin'=>true,
		),
         'cache' =>array(
			'class'=>'system.caching.CFileCache',
		),		
		// uncomment the following to enable URLs in path-format
	
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
	
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
        'authManager'=>array(
            'class'=>'RDbAuthManager',
            'connectionID'=>'db',
            'itemTable' =>'auth_item',
            'itemChildTable' =>'auth_item_child',
            'assignmentTable' =>'auth_assignment',
         ),
	
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
			 /*   array(
            'class' => 'ext.shiki.firePHPLogRoute.ShikiFirePHPLogRoute', 
            'libPath' => dirname(__FILE__) . '/../vendors/FirePHPCore/',
        ),*/
              /*  array(
  			'class'=>'XWebDebugRouter',
			'config'=>'alignLeft, opaque, runInDebug, fixedPos, collapsed',
			'levels'=>'error, warning, trace, profile, info',
     'allowedIPs'=>array('127.0.0.1','192.168.1.54'),
		), */
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error',
				),
				// uncomment the following to show log messages on web pages

			/*	array(
					'class'=>'CWebLogRoute',
				),
*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
        	'license'=>'images/patients',
        	'inventory'=>'images/inventory',
				'iconPack' => 'fugue',
        'patients'=>'images/patients',
			'imageRoot'=>'images',
				'jsRoot'=>'js',
'company'=>'kush11.com',
'logo'=>'kush11.png',
'address'=>'3303 Harbor Blvd K11',
'City'=>'Costa Mesa',
'State'=>'CA',
//Image Specifications
				'thumbWidth'=>90,
'thumbHeight'=>170,
'mainImageWidth'=>150,
'mainImageHeight'=>350,
		// this is used in contact page
		'adminEmail'=>'webmaster@nicknguyen.com',
	),
);