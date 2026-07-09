<?php

class ViewEngine{

    public static function transform(string $view,mixed $data = null) {
        try {
            if($data != null) extract($data);
            $viewsDir = ".\\views\\";

            // Replace dots for / so the $view string can look clean
            str_replace(".","/",$view);

            $viewPath = self::finder($view);
            
            if (!str_contains($viewPath,".raid.php") && $viewPath != '') {
                ob_start();
                include $viewPath;
                ob_get_flush();
                return;
            }

            if (!empty($viewPath)) {
                $template = file_get_contents($viewsDir.$view.'.raid.php');
                $content = preg_replace_callback_array(
                [
                    "/@include\(['\"](.*?)['\"]\)/" => function($match) {
                        str_replace('.php','',$match[1]);
                        return "<?php include './views/$match[1].php' ?>";
                    },
                    "/@layout\(['\"](.*?)['\"]\)/" => function($match) {
                        //TO DO
                    },
                    "/\{\{(.*?)\}\}/" => function ($match) {
                        return "<?= $match[1] ?>";
                    }
                ],
                $template);

                $compiled = './src/cache/' . $view . '.php';
                file_put_contents($compiled, $content);
                
                ob_start();
                include $compiled;
                ob_get_flush();
                return;
            }else{
                $template = './src/utils/defaultPages/default404.php';
                ob_start();
                include $template;
                ob_get_flush();
                return;
            }
            

        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    public static function finder(string $view, $dir = '.\\views\\'): string{
        $view = str_replace(['.', '/'], '\\', $view);

        $iterator = new DirectoryIterator($dir);

        foreach ($iterator as $file) {

            if ($file->isDot()) {
                continue;
            }

            $relative = str_replace('.\\views\\', '', $file->getPathname());
            if ($relative === $view . '.php' || $relative ===  $view . '.raid.php') {
                return $file->getPathname();
            }

            if ($file->isDir()) {
                $result = self::finder($view, $file->getPathname());

                if ($result !== '') {
                    return $result;
                }
            }
        }


        return '';
    }
}