<?php 
class LogicHook {
    function beforeSave(&$keyvalue) {
        
        
        $entity = lib_entity::getInstance();
        if(isset($keyvalue['isnew']) && $keyvalue['isnew']) {
             $keyval = array();
            $keyval['user_name'] = $keyvalue['username'];
            $keyval['name'] = $keyvalue['name'];
            $keyval['user_hash']  = md5($keyvalue['password']);
            $keyval['user_type'] = "user";
            $userId = $entity->save("user",$keyval);
            $keyvalue['ownership_id'] = $userId;
        }
        
      
    }
    
    
    function afterSave(&$keyvalue) {
        $entity = lib_entity::getInstance();
$globalModuleList = lib_datawrapper::getInstance()->get("module_list");
$db = lib_database::getInstance();

        
        if($keyvalue['date_entered']==$keyvalue['date_modified']) {
            $emailGroundId = $keyvalue['email_group'];
            $templateId = $keyvalue['mail_template_newsletter_job_1_m'];
            $outboundContextId = $keyvalue['outbound_context'];
            
            $emails = $entity->getRelationships("email_groups_emails_m_m","email_groups","emails",$emailGroundId);
        
            
            $template = $entity->get("mail_template",$templateId);
            
            foreach($emails as $email) {
                
                $emailBuffer = array();
                $emailBuffer['name'] = $template['name'];
                $emailBuffer['description'] = $template['message'];
                $emailBuffer['email_to'] = $email['name'];
                $emailBuffer['context'] = $outboundContextId;
                $emailBufferId = $entity->save("email_buffer",$emailBuffer);
                
                $data = array();
                $data['newsletter_job_id']  = $keyvalue['id'];
                $data['email_buffer_id'] = $emailBufferId;
                $entity->save("newsletter_job_email_buffer_1_m",$data);
                
            }
            
            
        }
        
        
        
        
    }
    
    
    function getEmailGroupEmails() {
        $db = lib_database::getInstance();
        
        
    }
}
?>