<?php
$mod_string = lib_datawrapper::getInstance()->get("mod_string_list");

$mod_string['LBL_ID'] = 'Id';
$mod_string['LBL_NAME'] = 'Name';
$mod_string['LBL_DESCRIPTION'] = 'Description';
$mod_string['LBL_DATE_ENTERED'] = 'Created On';
$mod_string['LBL_RELATED_RECORDS'] = 'Related Records';
lib_datawrapper::getInstance()->set("app_list_strings_list",$mod_string);
?>