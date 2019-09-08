<?php
global $vjconfig;
if( ((isset($_REQUEST['backend'])  && $_REQUEST['backend']=="fareglobal") || (isset($_SESSION['backend'])  && $_SESSION['backend']=="fareglobal")) ) {
    //$vjconfig['mysql']['database'] = "fareglobalsite";
  //  $vjconfig['sitename'] = "Fareglobal Control Panel";
//    $_SESSION['backend'] = "fareglobal";
}



