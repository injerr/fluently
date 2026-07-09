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
                // ob_start();
                // include $viewPath;
                // echo ob_get_clean();
                echo self::render($viewPath);
                return;
            }

            if (!empty($viewPath)) {
                $template = file_get_contents($viewsDir.$view.'.raid.php');
                $content = preg_replace_callback_array(
                [
                    "/@include\(['\"](.*?)['\"]\)/" => function($match) {
                        str_replace('.php','',$match[1]);
                        $view = str_replace(['.', '/'], '\\', $match[1]);
                        return "<?php include './views/$view.php' ?>";
                    },
                    "/@layout\(['\"](.*?)['\"]\)/" => function($match) {
                        //TO DO
                        return "";
                    },
                    "/@foreach\((.*?) as (.*?)\)/" => function($match) {
                        return "<?php foreach($match[1] as $match[2]): ?>";
                    },
                    "/@endforeach/" => function() {
                        return "<?php endforeach; ?>";
                    },
                    "/@if\((.*?)\)/" => function($match) {
                        return "<?php if($match[1]): ?>";
                    },
                    "/@elseif\((.*?)\)/" => function($match) {
                        return "<?php elseif($match[1]): ?>";
                    },
                    "/@else/" => function() {
                        return "<?php else: ?>";
                    },
                    "/@endif/" => function() {
                        return "<?php endif; ?>";
                    },
                    "/\{\{(.*?)\}\}/" => function ($match) {
                        return "<?=$match[1]?>";
                    }
                ],
                $template);

                $compiled = './src/cache/' . $view . '.php';
                file_put_contents($compiled, $content);
                
                // ob_start();
                // include $compiled;
                // ob_get_flush();
                echo self::render($compiled,$data);
                return;
            }else{
                $template = './src/utils/defaultPages/default404.php';
                // ob_start();
                // include $template;
                // ob_get_flush();
                echo self::render($template,$data);
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

    public static function render(string $view,mixed $data = null){
        if($data != null) extract($data);
        ob_start();
        include $view;
        return ob_get_clean();
    }
}