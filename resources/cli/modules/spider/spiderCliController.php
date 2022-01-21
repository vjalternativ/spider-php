<?php
$dir = __DIR__;
require_once $dir . '/SpiderService.php';

class spiderCliController extends CliResourceController
{

    function action_install()
    {
        echo "generating cache" . PHP_EOL;
        lib_entity::getInstance()->generateCache();
        echo "cache generated " . PHP_EOL;
        require_once lib_config::getInstance()->get('fwbasepath') . 'resources/backend/modules/adminarea/SchemaDataPatcher.php';

        $isDisableDB = lib_config::getInstance()->get("disabledb");
        if (! $isDisableDB) {
            $datapatch = new SchemaDataPatcher();
            $datapatch->addRepairTable("user");
            $datapatch->repairFramework();
        }
    }

    private function _init()
    {
        $config = lib_config::getInstance();
        $fwbasepath = $config->get("fwbasepath");
        $basepath = $config->get("basepath");
        echo $fwbasepath . PHP_EOL;

        // symbolic link generation
        // $cmd = 'ln -s ' . $fwbasepath . " " . $basepath . 'spider-php';
        // $this->exec($cmd);

        // templates_c generation
        $cmd = 'mkdir ' . $basepath . 'templates_c';
        $this->exec($cmd);

        // templates_c generation
        $cmd = 'mkdir ' . $basepath . 'cache';
        $this->exec($cmd);

        // cliconfig.php generation

        $path = trim($basepath, '/');
        $content = file_get_contents($fwbasepath . "include/templates/cliconfig.php");
        $content = str_replace("__BASEPATH__", $path, $content);
        file_put_contents($basepath . "cliconfig.php", $content);

        // config.php generation

        echo "do you want to configure database now? type y or n : ";
        $response = trim(fgets(STDIN));
        $response = strtolower($response);

        $configureDb = false;
        $dbname = "";
        $dbuser = "";
        $dbpassword = "";

        if ($response == "y" || $response == "yes") {
            $configureDb = true;

            echo "enter the database name : ";
            $response = trim(fgets(STDIN));
            $dbname = $response;
            echo "enter the database username : ";
            $response = trim(fgets(STDIN));
            $dbuser = $response;

            echo "enter the database password : ";
            $response = trim(fgets(STDIN));
            $dbpassword = $response;
        }

        $content = file_get_contents($fwbasepath . "include/templates/config.php");
        if ($configureDb) {
            $content = str_replace("__DBUSER__", $dbuser, $content);
            $content = str_replace("__DBPASSWORD__", $dbpassword, $content);
            $content = str_replace("__DBNAME__", $dbname, $content);
            $content = str_replace("__DISABLEDBVALUE__", 'false', $content);
        } else {
            $content = str_replace("__DISABLEDBVALUE__", 'true', $content);
        }

        file_put_contents($basepath . "config.php", $content);

        // htaccess generation
        $content = file_get_contents($fwbasepath . "include/templates/htaccess");
        file_put_contents($basepath . ".htaccess", $content);

        // htaccess generation
        $content = file_get_contents($fwbasepath . "include/templates/gitignore");
        file_put_contents($basepath . ".gitignore", $content);

        // copy resource folder
        $cmd = 'cp -r ' . $fwbasepath . 'include/templates/resources ' . $basepath;
        $this->exec($cmd);

        // copy buildpath configuration
        $content = file_get_contents($fwbasepath . "include/templates/buildpath");
        file_put_contents($basepath . ".buildpath", $content);

        // next step suggestion
        echo "enter below command to install" . PHP_EOL;
        echo "php " . $basepath . 'index.php spider install' . PHP_EOL;
    }

    function action_init()
    {
        $config = lib_config::getInstance();
        $basepath = $config->get("basepath");

        echo $basepath . PHP_EOL;
        if (file_exists($basepath . 'config.php')) {
            echo "PROJECT ALREADY INITIALIZED" . PHP_EOL;
        } else {
            $this->_init();
        }
    }

    function action_create()
    {
        $resource = $this->getarg(3);
        $module = $this->getarg(4);
        if ($resource && $module) {

            $view = $this->getarg(5);
            if ($view) {
                SpiderService::getInstance()->copyTemplateForResource($resource, $module, $view);
            } else {
                SpiderService::getInstance()->copyTemplateForResource($resource, $module);
            }
        } else {
            $this->echo("specify resource and module");
        }
    }

    function action_cleanup()
    {
        $vjconfig = lib_config::getInstance()->getConfig();
        $db = lib_database::getInstance();

        $sql = "select * from csvimporter where deleted = 1 ";

        $rows = $db->fetchRows($sql, array(
            "id"
        ));
        if ($rows) {
            foreach ($rows as $id => $name) {
                $sql = "select id from csvchunks where csvimorter='" . $id . "' limit 50";
                $rows = $db->fetchRows($sql, array(
                    "id"
                ), "id");
                if ($rows) {

                    $sql = "delete from csvchunks where id IN ('" . implode("','", $rows) . "')";
                    $db->query($sql);
                }
                $db->query($sql);
                $command = "rm -rf " . $vjconfig['basepath'] . "tmpuploads/" . $id;
                shell_exec($command);
            }
        }

        unlink($vjconfig['basepath'] . "framework.log");
        unlink($vjconfig['basepath'] . "service/logs/api/request.log");
    }
}
?>