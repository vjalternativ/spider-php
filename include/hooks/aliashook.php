<?php 
class AliasLogicHook {
    
    
    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        
        // trim
        $text = trim($text, '-');
        
        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        
        // lowercase
        $text = strtolower($text);
        
        if (empty($text)) {
            return 'n-a';
        }
        
        return $text;
    }
    
    function beforeSave(&$keyvalue) {
        $db = lib_mysqli::getInstance();
        $alias=self::slugify($keyvalue['name']);
        $keyvalue['alias']=$alias;
        if($keyvalue['isnew']) {
            $isExist = $db->getrow("select * from ".$keyvalue['hook_table']." where deleted=0 and alias ='".$keyvalue['alias']."' ");
            if($isExist) {
                die($keyvalue['hook_table']." record already exist with alias ".$alias);
            }
        }
        
    }
    
   
}
?>