<?php 
class pageViewEdit extends ViewEdit {
    
    function display() {
        parent::display();
    }
    
    function afterDisplay() {
        echo '<script src="include/vjlib/assets/ckeditor/ckeditor.js"></script>';
     //   echo '<link rel="stylesheet" href="modules/page/assets/css/edit.css" />';
        echo '<script src="modules/page/assets/js/edit.js"></script>';
        
    }
}
?>