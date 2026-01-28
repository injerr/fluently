<?php
CONST APP_NAME = "Fluently";


if (! function_exists('view')) {
    function view($template = null,$content = null): void{
        $app_name = APP_NAME;
        if ($content != null) {
            extract($content);
        }

        include_once('./views/comps/header/header.php');
        include_once('./views/comps/navbar/nav.html');
        if ($template != null){
            include($template);
        }
        include_once('./views/comps/footer/footer.php');
    }
}
