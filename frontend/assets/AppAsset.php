<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/custom';
    public $css = [        
       /* 'css/main.css',*/
        'css/main.min.css',

        /*'css/fancybox.css',*/
        'css/fancybox.min.css',

       /* 'fonts/flaticon.css',*/
        'fonts/flaticon.min.css',

        'plugins/font-awesome/css/font-awesome.min.css',       

        /*'css/plugins.css',*/
        'css/plugins.min.css',

        /*'./../../../../common/css/global.css',*/
         './../../../../common/css/global.min.css',
		 './../../../../common/css/style.css',

		'./../../themes/metronic/assets/global/plugins/simple-line-icons/simple-line-icons.min.css',
	
    ];
    public $js = [ 
		'./../../themes/metronic/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',	
		
    ];
}
