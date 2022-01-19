<?php
$vjconfig = lib_config::getInstance()->getConfig();
require_once $vjconfig['fwbasepath'] . 'resources/backend/modules/media_files/IMediaFilesService.php';
require_once $vjconfig['fwbasepath'] . 'resources/backend/modules/media_files/MediaFilesService.php';

class MediaFilesServiceRegistrar
{

    static $instance = null;

    static function getInstance()
    {
        if (self::$instance == null) {
            $instance = MediaFilesService::getInstance();
        }

        return self::getIMediaFilesService($instance);
    }

    private static function getIMediaFilesService(IMediaFilesService $ob)
    {
        return $ob;
    }
}
?>