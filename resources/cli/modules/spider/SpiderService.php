<?php

class SpiderService
{
    use CLIService;

    private static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new SpiderService();
        }
        return self::$instance;
    }

    private function getFiles($dir, $fileList = array())
    {
        $dir = rtrim($dir, "/");
        $dir .= '/';
        $files = scandir($dir);
        if ($files) {
            unset($files[0]);
            unset($files[1]);
            foreach ($files as $file) {

                $filepath = $dir . $file;

                if (is_dir($filepath)) {
                    $fileList = $this->getFiles($filepath, $fileList);
                } else {
                    $fileList[] = $filepath;
                }
            }
        }

        return $fileList;
    }

    private function replaceSpiderVars($str, $resource, $module, $view)
    {
        $str = str_replace("__MODULE__", $module, $str);
        $str = str_replace("__VIEW__", $view, $str);

        return $str;
    }

    public function copyTemplateForResource($resource, $module = false, $view = false)
    {
        $dirprefix = lib_config::getInstance()->get("fwbasepath") . 'include/templates/';

        $dir = $dirprefix . 'resources/' . $resource . '/';
        if ($module) {
            $dir .= 'modules/';
        }

        if ($view) {
            $dir .= 'modules/__MODULE__/views/';
        }

        $module = $module ? $module : "page";
        $view = $view ? $view : "default";

        $basepath = lib_config::getInstance()->get("basepath");
        $fileList = $this->getFiles($dir);
        foreach ($fileList as $file) {

            $content = file_get_contents($file);
            $relativePath = str_replace($dirprefix, "", $file);

            $relativePath = $this->replaceSpiderVars($relativePath, $resource, $module, $view);

            $content = $this->replaceSpiderVars($content, $resource, $module, $view);
            $targetPath = $basepath . $relativePath;

            $targetDir = substr($targetPath, 0, strrpos($targetPath, "/"));

            if (! is_dir($targetDir)) {
                $cmd = 'mkdir -p ' . $targetDir;

                $this->exec($cmd);
            }

            if (! file_exists($targetPath)) {
                file_put_contents($targetPath, $content);
            }
        }
    }
}
?>