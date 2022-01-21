<?php
require_once lib_config::getInstance()->get('fwbasepath') . 'resources/cli/modules/cron/CronService.php';

class schedulerViewEdit extends ViewEdit
{

    function preDisplay()
    {
        parent::preDisplay();

        $appListStrings = lib_datawrapper::getInstance()->get("app_list_strings_list");

        $modules = CronService::getInstance()->getCronModules();

        $moduleList = array_keys($modules);

        $functionList = array();
        if ($moduleList) {

            if (isset($this->data['module'])) {
                $active = $this->data['module'];

                if (isset($modules[$active])) {
                    $functionList = $modules[$active]['functions'];
                    $functionList = array_combine($functionList, $functionList);
                }
            }
        }
        $moduleList = array_combine($moduleList, $moduleList);

        $appListStrings['cron_module_list'] = $moduleList;
        $appListStrings['cron_module_function_list'] = $functionList;

        lib_datawrapper::getInstance()->set("app_list_strings_list", $appListStrings);

        $this->def['fields']['module']['type'] = "enum";
        $this->def['fields']['module']['options'] = "cron_module_list";
        $this->def['fields']['method']['type'] = "enum";
        $this->def['fields']['method']['options'] = "cron_module_function_list";
    }
}

?>