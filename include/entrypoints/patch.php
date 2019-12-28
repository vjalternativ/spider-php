<?php 
class PatchInstaller {
    function executePatch() {
        global $entity,$vjconfig;
        
        
        
        $base = 'eyJmaWVsZHMiOnsiaWQiOnsibmFtZSI6ImlkIiwidHlwZSI6ImlkIiwibm90bnVsbCI6dHJ1ZSwibGFiZWwiOiJMQkxfSUQifSwibmFtZSI6eyJuYW1lIjoibmFtZSIsInR5cGUiOiJ2YXJjaGFyIiwibGVuIjoyNTUsImxpbmsiOnRydWUsImxhYmVsIjoiTEJMX05BTUUifSwiZGVzY3JpcHRpb24iOnsibmFtZSI6ImRlc2NyaXB0aW9uIiwidHlwZSI6InRleHQiLCJsYWJlbCI6IkxCTF9ERVNDUklQVElPTiJ9LCJkYXRlX2VudGVyZWQiOnsibmFtZSI6ImRhdGVfZW50ZXJlZCIsInR5cGUiOiJkYXRldGltZSIsIm5vdG51bGwiOnRydWUsImxhYmVsIjoiTEJMX0RBVEVfRU5URVJFRCJ9LCJkYXRlX21vZGlmaWVkIjp7Im5hbWUiOiJkYXRlX21vZGlmaWVkIiwidHlwZSI6ImRhdGV0aW1lIiwibm90bnVsbCI6dHJ1ZSwibGFiZWwiOiJMQkxfREFURV9NT0RJRklFRCJ9LCJkZWxldGVkIjp7Im5hbWUiOiJkZWxldGVkIiwidHlwZSI6ImludCIsImRlZmF1bHQiOjAsImxhYmVsIjoiTEJMX0RFTEVURUQifSwibW9kaWZpZWRfdXNlcl9pZCI6eyJuYW1lIjoibW9kaWZpZWRfdXNlcl9pZCIsInR5cGUiOiJyZWxhdGUiLCJybW9kdWxlIjoidXNlciIsIm5vdG51bGwiOnRydWUsImxhYmVsIjoiTEJMX01PRElGSUVEX1VTRVJfSUQifSwiY3JlYXRlZF9ieSI6eyJuYW1lIjoiY3JlYXRlZF9ieSIsInR5cGUiOiJyZWxhdGUiLCJybW9kdWxlIjoidXNlciIsIm5vdG51bGwiOnRydWUsImxhYmVsIjoiTEJMX0NSRUFURURfQlkifSwiZW1haWxfdG8iOnsibmFtZSI6ImVtYWlsX3RvIiwidHlwZSI6InRleHQifSwiZW1haWxfY2MiOnsibmFtZSI6ImVtYWlsX2NjIiwidHlwZSI6InRleHQifSwiZW1haWxfYmNjIjp7Im5hbWUiOiJlbWFpbF9iY2MiLCJ0eXBlIjoidGV4dCJ9LCJlbWFpbF9oZWFkZXIiOnsibmFtZSI6ImVtYWlsX2hlYWRlciIsInR5cGUiOiJ2YXJjaGFyIiwibGVuIjoiMjU1In0sImVtYWlsX2JvZHkiOnsibmFtZSI6ImVtYWlsX2JvZHkiLCJ0eXBlIjoidGV4dCJ9LCJjb250ZXh0Ijp7Im5hbWUiOiJjb250ZXh0IiwidHlwZSI6InJlbGF0ZSIsInJtb2R1bGUiOiJvdXRib3VuZF9lbWFpbF9jb250ZXh0IiwibGVuIjoiMzYifSwiaXNfc2VudF9zdWNjZXNzZnVsbHkiOnsibmFtZSI6ImlzX3NlbnRfc3VjY2Vzc2Z1bGx5IiwidHlwZSI6ImNoZWNrYm94In0sInNlbmRfYXR0ZW1wdHMiOnsibmFtZSI6InNlbmRfYXR0ZW1wdHMiLCJ0eXBlIjoiaW50In0sInNlbmRpbmdfZXJyb3IiOnsibmFtZSI6InNlbmRpbmdfZXJyb3IiLCJ0eXBlIjoidmFyY2hhciIsImxlbiI6IjI1NSJ9LCJsYXN0X2F0dGVtcHQiOnsibmFtZSI6Imxhc3RfYXR0ZW1wdCIsInR5cGUiOiJkYXRldGltZSJ9LCJhdHRhY2htZW50cyI6eyJuYW1lIjoiYXR0YWNobWVudHMiLCJ0eXBlIjoidGV4dCJ9LCJlbWJlZGRlZF9pbWFnZXMiOnsibmFtZSI6ImVtYmVkZGVkX2ltYWdlcyIsInR5cGUiOiJ2YXJjaGFyIiwibGVuIjoiMTAyNCJ9LCJzZW5kZnJvbSI6eyJuYW1lIjoic2VuZGZyb20iLCJ0eXBlIjoidmFyY2hhciIsImxlbiI6IjI1NSJ9LCJuZXdzbGV0dGVyX2pvYl9lbWFpbF9idWZmZXJfMV9tIjp7Im5hbWUiOiJuZXdzbGV0dGVyX2pvYl9lbWFpbF9idWZmZXJfMV9tIiwidHlwZSI6Im5vbmRiIiwicm1vZHVsZSI6Im5ld3NsZXR0ZXJfam9iIiwibGFiZWwiOiJKb2IifX0sIm1ldGFkYXRhIjp7Imxpc3R2aWV3Ijp7Im5hbWUiOnsibmFtZSI6Im5hbWUiLCJ0eXBlIjoidmFyY2hhciIsImxlbiI6MjU1LCJsaW5rIjp0cnVlLCJsYWJlbCI6IkxCTF9OQU1FIn0sImRhdGVfZW50ZXJlZCI6eyJuYW1lIjoiZGF0ZV9lbnRlcmVkIiwidHlwZSI6ImRhdGV0aW1lIiwibm90bnVsbCI6dHJ1ZSwibGFiZWwiOiJMQkxfREFURV9FTlRFUkVEIn0sImVtYWlsX3RvIjp7Im5hbWUiOiJlbWFpbF90byIsInR5cGUiOiJ0ZXh0In0sImlzX3NlbnRfc3VjY2Vzc2Z1bGx5Ijp7Im5hbWUiOiJpc19zZW50X3N1Y2Nlc3NmdWxseSIsInR5cGUiOiJjaGVja2JveCJ9fSwiZWRpdHZpZXciOnsibmFtZSI6eyJmaWVsZHMiOlt7ImZpZWxkIjp7Im5hbWUiOiJuYW1lIiwidHlwZSI6InZhcmNoYXIiLCJsZW4iOjI1NSwibGluayI6dHJ1ZSwibGFiZWwiOiJMQkxfTkFNRSJ9LCJncmlkc2l6ZSI6Nn1dLCJ0eXBlIjoicm93In0sImRlc2NyaXB0aW9uIjp7ImZpZWxkcyI6W3siZmllbGQiOnsibmFtZSI6ImRlc2NyaXB0aW9uIiwidHlwZSI6InRleHQiLCJsYWJlbCI6IkxCTF9ERVNDUklQVElPTiJ9LCJncmlkc2l6ZSI6MTJ9XSwidHlwZSI6InJvdyJ9fSwiZGV0YWlsdmlldyI6W3sidHlwZSI6InJvdyIsImZpZWxkcyI6W3siZmllbGQiOnsibmFtZSI6Im5hbWUiLCJ0eXBlIjoidmFyY2hhciIsImxlbiI6MjU1LCJsaW5rIjp0cnVlLCJsYWJlbCI6IkxCTF9OQU1FIn0sImdyaWRzaXplIjoiNiJ9LHsiZmllbGQiOnsibmFtZSI6ImRhdGVfZW50ZXJlZCIsInR5cGUiOiJkYXRldGltZSIsIm5vdG51bGwiOnRydWUsImxhYmVsIjoiTEJMX0RBVEVfRU5URVJFRCJ9LCJncmlkc2l6ZSI6IjYifV19LHsidHlwZSI6InJvdyIsImZpZWxkcyI6W3siZmllbGQiOnsibmFtZSI6ImRlc2NyaXB0aW9uIiwidHlwZSI6InRleHQiLCJsYWJlbCI6IkxCTF9ERVNDUklQVElPTiJ9LCJncmlkc2l6ZSI6IjEyIn1dfSx7InR5cGUiOiJyb3ciLCJmaWVsZHMiOlt7ImZpZWxkIjp7Im5hbWUiOiJlbWFpbF90byIsInR5cGUiOiJ0ZXh0In0sImdyaWRzaXplIjoiNiJ9LHsiZmllbGQiOnsibmFtZSI6ImNvbnRleHQiLCJ0eXBlIjoicmVsYXRlIiwicm1vZHVsZSI6Im91dGJvdW5kX2VtYWlsX2NvbnRleHQiLCJsZW4iOiIzNiJ9LCJncmlkc2l6ZSI6IjYifV19LHsidHlwZSI6InJvdyIsImZpZWxkcyI6W3siZmllbGQiOnsibmFtZSI6ImlzX3NlbnRfc3VjY2Vzc2Z1bGx5IiwidHlwZSI6ImNoZWNrYm94In0sImdyaWRzaXplIjoiNiJ9LHsiZmllbGQiOnsibmFtZSI6Imxhc3RfYXR0ZW1wdCIsInR5cGUiOiJkYXRldGltZSJ9LCJncmlkc2l6ZSI6IjYifV19LHsidHlwZSI6InJvdyIsImZpZWxkcyI6W3siZmllbGQiOnsibmFtZSI6InNlbmRpbmdfZXJyb3IiLCJ0eXBlIjoidmFyY2hhciIsImxlbiI6IjI1NSJ9LCJncmlkc2l6ZSI6IjYifSx7ImZpZWxkIjp7Im5hbWUiOiJzZW5kZnJvbSIsInR5cGUiOiJ2YXJjaGFyIiwibGVuIjoiMjU1In0sImdyaWRzaXplIjoiNiJ9XX1dLCJzZWFyY2h2aWV3Ijp7Im5hbWUiOnsibmFtZSI6Im5hbWUiLCJ0eXBlIjoidmFyY2hhciIsImxlbiI6MjU1LCJsaW5rIjp0cnVlLCJsYWJlbCI6IkxCTF9OQU1FIn19fX0=';
        
        $json = json_decode(base64_decode($base),1);
        
        
        $defaultFields =array('id','name','description','date_entered','date_modified','deleted','modified_user_id','created_by','assigned_user_id');
        
        
        foreach($json['fields'] as $key=>$val) {
            if($val['type']=="nondb") {
                unset($json[$key]);
            }
        }
        
        foreach($json['fields'] as $key=>$val) {
            if(in_array($key, $defaultFields) || $val['type']=="nondb") {
                unset($json['fields'][$key]);
            } 
           
        } 
        
        foreach($json['metadata'] as $vkey=>$view) {
            foreach($view as $key=>$val) {
                
            
                if(in_array($key, $defaultFields) || $val['type']=="nondb") {
                    unset($json['metadata'][$vkey][$key]);
                }
            
            
            }
            
            if(empty($json['metadata'][$vkey])) {
                unset($json['metadata'][$vkey]);
            }
            
        } 
        
        
        $json['type'] = "basic";
        $json['label'] = "email_buffer";
        
        $content = file_get_contents($vjconfig['fwbasepath']."include/vjlib/templates/tableinfo_data.php");
        $content = str_replace("__TABLEINFO_DATA__", var_export($json,1), $content);
        $content = str_replace("__TABLE_INFO_NAME__", $json['label'], $content);
        file_put_contents($vjconfig['fwbasepath']."include/entrypoints/install/".$json['label'].".php", $content);
        die;
               
        
        
        
    }
}
$patch = new PatchInstaller();
$patch->executePatch();
?>