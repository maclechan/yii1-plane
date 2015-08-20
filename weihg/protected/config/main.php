<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'΢�鹺',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.admin.*',
		'application.modules.admin.models.*',	
		'application.modules.shqq.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

		'admin'=>array(
			'defaultController' => 'handle',
			'modules'=>array(
				'site'=>array(
					'defaultController' => 'handle/noticelist',
					'modules'=>array()
				),
				'member'=>array(
					'defaultController' => 'member',
					'modules'=>array()
				),	
				'etp'=>array(
					'defaultController' => 'handle',
					'modules'=>array()
				),
				'guwen'=>array(
					'defaultController' => 'handle',
					'modules'=>array()
				),				
			)),
		'manage'=>array(
			'defaultController' => 'handle',
			'modules'=>array()
		),
		'shqq'=>array(
			'defaultController' => 'default',
			'modules'=>array()
		),	
		'assocer'=>array(
			'defaultController' => 'handle',
			'modules'=>array()
		),		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>'/login.html',
			'authTimeout'=>'86400',		
		),
		'session'=>array(
			'timeout'=>'86400',
		),	
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'urlSuffix'=>'.html',
			'showScriptName' => false,
			'rules'=>array(
				'admin/sign'=>'admin/handle/sign',
			),
		),
		
/* 		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		), */
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=weihgdb',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '123456',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'wxpay'=>array(
			'class'=>'application.extensions.wxpay.WechatPay',
	    ),		
		'UploadReceive'=>array(
			'class'=>'application.extensions.fileupload.UploadReceive',
	    ),
	    'uploadimg'=>array(
			'class'=>'application.extensions.upload_img.UploadImg',
	    ),		
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'upload'=>'upload/'
	),
);