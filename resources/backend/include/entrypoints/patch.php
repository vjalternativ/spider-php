<?php 
class PatchInstaller {
    function executePatch() {
        global $entity,$vjconfig;
        
        
        
        $base = 'eyJmaWVsZHMiOnsiaWQiOnsibmFtZSI6ImlkIiwidHlwZSI6ImlkIiwibm90bnVsbCI6dHJ1ZSwibGFiZWwiOiJMQkxfSUQifSwibmFtZSI6eyJuYW1lIjoibmFtZSIsInR5cGUiOiJ2YXJjaGFyIiwibGVuIjoyNTUsImxpbmsiOnRydWUsImxhYmVsIjoiTEJMX05BTUUifSwiZGVzY3JpcHRpb24iOnsibmFtZSI6ImRlc2NyaXB0aW9uIiwidHlwZSI6InRleHQiLCJsYWJlbCI6IkxCTF9ERVNDUklQVElPTiJ9LCJkYXRlX2VudGVyZWQiOnsibmFtZSI6ImRhdGVfZW50ZXJlZCIsInR5cGUiOiJkYXRldGltZSIsIm5vdG51bGwiOnRydWUsImxhYmVsIjoiTEJMX0RBVEVfRU5URVJFRCJ9LCJkYXRlX21vZGlmaWVkIjp7Im5hbWUiOiJkYXRlX21vZGlmaWVkIiwidHlwZSI6ImRhdGV0aW1lIiwibm90bnVsbCI6dHJ1ZSwibGFiZWwiOiJMQkxfREFURV9NT0RJRklFRCJ9LCJkZWxldGVkIjp7Im5hbWUiOiJkZWxldGVkIiwidHlwZSI6ImludCIsImRlZmF1bHQiOjAsImxhYmVsIjoiTEJMX0RFTEVURUQifSwibW9kaWZpZWRfdXNlcl9pZCI6eyJuYW1lIjoibW9kaWZpZWRfdXNlcl9pZCIsInR5cGUiOiJyZWxhdGUiLCJybW9kdWxlIjoidXNlciIsIm5vdG51bGwiOnRydWUsImxhYmVsIjoiTEJMX01PRElGSUVEX1VTRVJfSUQifSwiY3JlYXRlZF9ieSI6eyJuYW1lIjoiY3JlYXRlZF9ieSIsInR5cGUiOiJyZWxhdGUiLCJybW9kdWxlIjoidXNlciIsIm5vdG51bGwiOnRydWUsImxhYmVsIjoiTEJMX0NSRUFURURfQlkifSwicGF0aCI6eyJuYW1lIjoicGF0aCIsInR5cGUiOiJ2YXJjaGFyIiwibGVuIjoiMjU1In0sImlubWludXRlIjp7Im5hbWUiOiJpbm1pbnV0ZSIsInR5cGUiOiJpbnQifSwiam9iY2xhc3MiOnsibmFtZSI6ImpvYmNsYXNzIiwidHlwZSI6InZhcmNoYXIiLCJsZW4iOiIyNTUifSwic3RhdHVzIjp7Im5hbWUiOiJzdGF0dXMiLCJ0eXBlIjoiZW51bSIsIm9wdGlvbnMiOiJzdGF0dXNfbGlzdCIsImxlbiI6IjI1NSJ9LCJqb2JzdGF0dXMiOnsibmFtZSI6ImpvYnN0YXR1cyIsInR5cGUiOiJ2YXJjaGFyIiwibGVuIjoiMjU1In19LCJtZXRhZGF0YSI6eyJsaXN0dmlldyI6eyJuYW1lIjp7Im5hbWUiOiJuYW1lIiwidHlwZSI6InZhcmNoYXIiLCJsZW4iOjI1NSwibGluayI6dHJ1ZSwibGFiZWwiOiJMQkxfTkFNRSJ9LCJkYXRlX2VudGVyZWQiOnsibmFtZSI6ImRhdGVfZW50ZXJlZCIsInR5cGUiOiJkYXRldGltZSIsIm5vdG51bGwiOnRydWUsImxhYmVsIjoiTEJMX0RBVEVfRU5URVJFRCJ9LCJzdGF0dXMiOnsibmFtZSI6InN0YXR1cyIsInR5cGUiOiJlbnVtIiwib3B0aW9ucyI6InN0YXR1c19saXN0IiwibGVuIjoiMjU1In0sImpvYnN0YXR1cyI6eyJuYW1lIjoiam9ic3RhdHVzIiwidHlwZSI6InZhcmNoYXIiLCJsZW4iOiIyNTUifSwiZGF0ZV9tb2RpZmllZCI6eyJuYW1lIjoiZGF0ZV9tb2RpZmllZCIsInR5cGUiOiJkYXRldGltZSIsIm5vdG51bGwiOnRydWUsImxhYmVsIjoiTEJMX0RBVEVfTU9ESUZJRUQifX0sImVkaXR2aWV3IjpbeyJ0eXBlIjoicm93IiwiZmllbGRzIjpbeyJmaWVsZCI6eyJuYW1lIjoibmFtZSIsInR5cGUiOiJ2YXJjaGFyIiwibGVuIjoyNTUsImxpbmsiOnRydWUsImxhYmVsIjoiTEJMX05BTUUifSwiZ3JpZHNpemUiOiI2In1dfSx7InR5cGUiOiJyb3ciLCJmaWVsZHMiOlt7ImZpZWxkIjp7Im5hbWUiOiJkZXNjcmlwdGlvbiIsInR5cGUiOiJ0ZXh0IiwibGFiZWwiOiJMQkxfREVTQ1JJUFRJT04ifSwiZ3JpZHNpemUiOiIxMiJ9XX0seyJ0eXBlIjoicm93IiwiZmllbGRzIjpbeyJmaWVsZCI6eyJuYW1lIjoicGF0aCIsInR5cGUiOiJ2YXJjaGFyIiwibGVuIjoiMjU1In0sImdyaWRzaXplIjoiNiJ9LHsiZmllbGQiOnsibmFtZSI6ImlubWludXRlIiwidHlwZSI6ImludCJ9LCJncmlkc2l6ZSI6IjYifV19LHsidHlwZSI6InJvdyIsImZpZWxkcyI6W3siZmllbGQiOnsibmFtZSI6ImpvYmNsYXNzIiwidHlwZSI6InZhcmNoYXIiLCJsZW4iOiIyNTUifSwiZ3JpZHNpemUiOiI2In0seyJmaWVsZCI6eyJuYW1lIjoic3RhdHVzIiwidHlwZSI6ImVudW0iLCJvcHRpb25zIjoic3RhdHVzX2xpc3QiLCJsZW4iOiIyNTUifSwiZ3JpZHNpemUiOiI2In1dfSx7InR5cGUiOiJyb3ciLCJmaWVsZHMiOlt7ImZpZWxkIjp7Im5hbWUiOiJqb2JzdGF0dXMiLCJ0eXBlIjoidmFyY2hhciIsImxlbiI6IjI1NSJ9LCJncmlkc2l6ZSI6IjYifV19XSwiZGV0YWlsdmlldyI6eyJuYW1lIjp7ImZpZWxkcyI6W3siZmllbGQiOnsibmFtZSI6Im5hbWUiLCJ0eXBlIjoidmFyY2hhciIsImxlbiI6MjU1LCJsaW5rIjp0cnVlLCJsYWJlbCI6IkxCTF9OQU1FIn0sImdyaWRzaXplIjo2fSx7ImZpZWxkIjp7Im5hbWUiOiJkYXRlX2VudGVyZWQiLCJ0eXBlIjoiZGF0ZXRpbWUiLCJub3RudWxsIjp0cnVlLCJsYWJlbCI6IkxCTF9EQVRFX0VOVEVSRUQifSwiZ3JpZHNpemUiOjZ9XSwidHlwZSI6InJvdyJ9LCJkZXNjcmlwdGlvbiI6eyJmaWVsZHMiOlt7ImZpZWxkIjp7Im5hbWUiOiJkZXNjcmlwdGlvbiIsInR5cGUiOiJ0ZXh0IiwibGFiZWwiOiJMQkxfREVTQ1JJUFRJT04ifSwiZ3JpZHNpemUiOjEyfV0sInR5cGUiOiJyb3cifX0sInNlYXJjaHZpZXciOnsibmFtZSI6eyJuYW1lIjoibmFtZSIsInR5cGUiOiJ2YXJjaGFyIiwibGVuIjoyNTUsImxpbmsiOnRydWUsImxhYmVsIjoiTEJMX05BTUUifX19fQ==';
        
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
        $json['label'] = "scheduler";
        
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