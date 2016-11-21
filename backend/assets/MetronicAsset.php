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
        /*
         * backend\views\layouts\user_login.php STYLESHEETS
         * */
        /* BEGIN GLOBAL MANDATORY STYLES */
        'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all',
        'assets/global/plugins/font-awesome/css/font-awesome.min.css',
        'assets/global/plugins/simple-line-icons/simple-line-icons.min.css',
        'assets/global/plugins/bootstrap/css/bootstrap.min.css',
        'assets/global/plugins/uniform/css/uniform.default.css',
        'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
        /* END GLOBAL MANDATORY STYLES */
        /* BEGIN PAGE LEVEL PLUGINS */
        'assets/global/plugins/select2/css/select2.min.css',
        'assets/global/plugins/select2/css/select2-bootstrap.min.css',
        /* END PAGE LEVEL PLUGINS */
        /* BEGIN THEME GLOBAL STYLES */
        'assets/global/css/components.min.css',
        'assets/global/css/plugins.min.css',
        /* END THEME GLOBAL STYLES */
        /* BEGIN PAGE LEVEL STYLES */
        'assets/pages/css/login.min.css',
        /* END PAGE LEVEL STYLES */
        /* BEGIN THEME LAYOUT STYLES */
        /* END THEME LAYOUT STYLES */
    ];
    public $js = [
        /*
         * backend\views\layouts\user_login.php SCRIPTS
         * */
        /* BEGIN CORE PLUGINS */
        'assets/global/plugins/jquery.min.js',
        'assets/global/plugins/bootstrap/js/bootstrap.min.js',
        'assets/global/plugins/js.cookie.min.js',
        'assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
        'assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'assets/global/plugins/jquery.blockui.min.js',
        'assets/global/plugins/uniform/jquery.uniform.min.js',
        'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        /* END CORE PLUGINS */
        /* BEGIN PAGE LEVEL PLUGINS */
        'assets/global/plugins/jquery-validation/js/jquery.validate.min.js',
        'assets/global/plugins/jquery-validation/js/additional-methods.min.js',
        'assets/global/plugins/select2/js/select2.full.min.js',
        /* END PAGE LEVEL PLUGINS */
        /* BEGIN THEME GLOBAL SCRIPTS */
        'assets/global/scripts/app.min.js',
        /* END THEME GLOBAL SCRIPTS */
        /* BEGIN PAGE LEVEL SCRIPTS */
        'assets/pages/scripts/login.min.js',
        /* END PAGE LEVEL SCRIPTS */
        /* BEGIN THEME LAYOUT SCRIPTS */
        /* END THEME LAYOUT SCRIPTS */
    ];
    public $depends = [
    ];
}
