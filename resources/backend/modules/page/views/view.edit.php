<?php 
class pageViewEdit extends ViewEdit {
    
    function display() {
        parent::display();
    }
    
    function afterDisplay() {
        echo '<script src="include/vjlib/assets/ckeditor/ckeditor.js"></script>';
     //   echo '<link rel="stylesheet" href="resources/backend/modules/page/assets/css/edit.css" />';
        echo '<script src="resources/backend/modules/page/assets/js/edit.js"></script>';
        
    }
}
?>