<?php

class CronService
{

    private static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new CronService();
        }
        return self::$instance;
    }

    private function get_defined_functions_in_file($file)
    {
        $cmd = "grep 'function action_' " . $file;

        $res = shell_exec($cmd);
        $res = trim($res);

        $functions = array();
        if ($res) {

            $lines = explode("\n", $res);

            foreach ($lines as $line) {
                $line = trim($line);
                if ($line) {
                    $line = str_replace(" ", "", $line);
                    $line = str_replace("functionaction_", "", $line);
                    $arr = explode("(", $line);

                    if (count($arr) == 2) {
                        $line = $arr[0];
                        $functions[] = $line;
                    }
                }
            }
        }
        return $functions;
    }

    private function getFiles($path, $data = array())
    {
        $path = rtrim($path) . '/';
        $files = scandir($path);

        if ($files) {
            unset($files[0]);
            unset($files[1]);
            foreach ($files as $file) {

                if (is_dir($path . $file)) {

                    $filepath = $path . $file . '/' . $file . 'CliController.php';
                    if (file_exists($filepath)) {

                        if ($file == "cron" || $file == "cronprocess") {
                            continue;
                        }

                        $functions = $this->get_defined_functions_in_file($filepath);

                        if ($functions) {
                            $data[$file] = array(
                                "filepath" => $filepath,
                                "functions" => $functions
                            );
                        }
                    }
                } else {
                    echo $path . $file . "is not a directory<br />";
                }
            }
        }

        return $data;
    }

    public function getCronModules()
    {
        $config = lib_config::getInstance();

        $fwbasepath = $config->get("fwbasepath");

        $basepath = $config->get("basepath");

        $modules = $this->getFiles($fwbasepath . 'resources/cli/modules');

        $modules = $this->getFiles($basepath . 'resources/cli/modules', $modules);

        return $modules;
    }
}
?>