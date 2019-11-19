<?php
require_once 'modules/user/authenticate/Authenticate.php';
require_once 'service/rest/api/ARest.php';

class userRest extends ARest
{

    public function action_authenticate($data)
    {
        global $entity, $db;
        $status = array(
            "status" => false
        );
        
        if($current_user && $current_user->id) {
            echo json_encode($status);
            exit();
        }
        
        $autheticate = new Authenticate();
        if (isset($data["auth_type"]) && $data['auth_type'] == "google" ) {
            $mod = "user";
            if (isset($data['user_type'])) {
                $mod = $data['user_type'];
            }
            $userData = file_get_contents("https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=" . $data['id_token']);
            $jsonArray = json_decode($userData, 1);
            // $json = '{"id":"110447668149638590894","email":"vj.alternativ@gmail.com","verified_email":true,"name":"VIJAY KUMAR","given_name":"VIJAY","family_name":"KUMAR","picture":"https://lh3.google.com/a-/AAuE7mAUeAbltnC3Tv09SaHAFmeYwT55zAfj1e0iPkhK","locale":"en","result":{"id":"110447668149638590894","email":"vj.alternativ@gmail.com","verified_email":true,"name":"VIJAY KUMAR","given_name":"VIJAY","family_name":"KUMAR","picture":"https://lh3.google.com/a-/AAuE7mAUeAbltnC3Tv09SaHAFmeYwT55zAfj1e0iPkhK","locale":"en"}}';

            if (is_array($jsonArray) && isset($jsonArray['email'])) {
                $sql = "select * from " . $mod . " where username = '" . $jsonArray['email'] . "' and deleted=0";
                $userData = $db->getrow($sql);
                
                $beanData = array();
                
                if($userData) {
                    $sql = "select * from user where id='".$userData['ownership_id']."' and deleted=0 ";
                    $beanData = $db->getrow($sql);  
                } else {
                    $userData['name'] = $jsonArray['name'];
                    $userData['username'] = $jsonArray['email'];
                    $userData['password'] = rand(10000, 99999);
                    $entity->save($mod, $userData);
                    
                    if (isset($entity->beandata['user'])) {
                        $beanData = $entity->beandata['user'];
                    }
                    
                }
                if ($beanData) {
                    $autheticate->processSession($beanData);

                    $status = array(
                        "status" => true
                    );
                }
            }
        }

        echo json_encode($status);
    }
    
    
    public function action_logout() {
        session_destroy();
    }
}