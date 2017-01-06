<?php
namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Metronic backend application assets.
 */
class MetronicAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all',
        'https://fonts.googleapis.com/css?family=Oswald:400,300,700',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
        'assets/global/plugins/font-awesome/css/font-awesome.min.css',
        'assets/global/plugins/simple-line-icons/simple-line-icons.min.css',
        'assets/global/plugins/bootstrap/css/bootstrap.min.css',
        'assets/global/plugins/uniform/css/uniform.default.css',
        'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
        'assets/global/plugins/select2/css/select2.min.css',
        'assets/global/plugins/select2/css/select2-bootstrap.min.css',
        'assets/global/css/components.min.css',
        'assets/global/css/plugins.min.css',
        'assets/pages/css/login.min.css',
        'assets/layouts/layout5/css/layout.min.css',
        'assets/layouts/layout5/css/custom.min.css',
        'assets/pages/css/error.min.css',
    ];
    public $js = [
        'assets/global/plugins/jquery.min.js',
        'assets/global/plugins/bootstrap/js/bootstrap.min.js',
        'assets/global/plugins/js.cookie.min.js',
        'assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
        'assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'assets/global/plugins/jquery.blockui.min.js',
        'assets/global/plugins/uniform/jquery.uniform.min.js',
        'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        'assets/global/plugins/jquery-validation/js/jquery.validate.min.js',
        'assets/global/plugins/jquery-validation/js/additional-methods.min.js',
        'assets/global/plugins/select2/js/select2.full.min.js',
        'assets/global/scripts/app.min.js',
        'assets/pages/scripts/login.min.js',
        'assets/layouts/layout5/scripts/layout.min.js',
        'assets/layouts/global/scripts/quick-sidebar.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
