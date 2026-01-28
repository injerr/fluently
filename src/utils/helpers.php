<?php

if (! function_exists('view')) {
    function view($template = null,$content = null): void{
        if ($content != null) {
            extract($content);
        }

        include_once('./views/comps/header/header.php');
        include_once('./views/comps/navbar/nav.php');
        if ($template != null){
            include($template);
        }
        include_once('./views/comps/footer/footer.php');
    }
}
