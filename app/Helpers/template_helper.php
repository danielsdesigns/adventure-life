<?php

if(!function_exists('version')) {

    function version(){
        $version = 1.0;
        return $_SERVER['CI_ENVIRONMENT'] == 'production' ? "?v=".$version : "?v=".time();
    }
}

if(!function_exists('assets')) {

    function assets($asset) {

        return base_url("assets/".$asset.version());

    }

}

if(!function_exists('css')) {

    function css($css) {

        return base_url("assets/css/".$css.version());

    }

}

if(!function_exists('js')) {

    function js($js) {

        return base_url("assets/js/".$js.version());

    }

}

if(!function_exists('image')) {

    function image($image) {

        return base_url("assets/images/".$image);

    }

}

if(!function_exists('gotopage')) {

    function gotopage($page='/'){
        $page = base_url($page);
        header("Location:{$page}");
        exit;
    }

}

?>