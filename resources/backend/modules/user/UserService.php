<?php
require_once lib_config::getInstance()->get("fwbasepath") . 'resources/backend/modules/user/authenticate/Authenticate.php';

class UserService
{

    private static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new UserService();
        }
        return self::$instance;
    }

    function loginWithRegister($userInfo, $mod = "user", $resource = "frontend")
    {
        $autheticate = new Authenticate();
        $db = lib_database::getInstance();
        $entity = lib_entity::getInstance();

        // $json = '{"id":"110447668149638590894","email":"vj.alternativ@gmail.com","verified_email":true,"name":"VIJAY KUMAR","given_name":"VIJAY","family_name":"KUMAR","picture":"https://lh3.google.com/a-/AAuE7mAUeAbltnC3Tv09SaHAFmeYwT55zAfj1e0iPkhK","locale":"en","result":{"id":"110447668149638590894","email":"vj.alternativ@gmail.com","verified_email":true,"name":"VIJAY KUMAR","given_name":"VIJAY","family_name":"KUMAR","picture":"https://lh3.google.com/a-/AAuE7mAUeAbltnC3Tv09SaHAFmeYwT55zAfj1e0iPkhK","locale":"en"}}';
        // $userInfo = json_decode($userData, 1);

        if (is_array($userInfo) && isset($userInfo['email'])) {
            $sql = "select * from " . $mod . " where username = '" . $userInfo['email'] . "' and deleted=0";
            echo $sql . "<br />";
            $userData = $db->getrow($sql);

            $beanData = array();

            if ($userData) {
                $sql = "select * from user where id='" . $userData['ownership_id'] . "' and deleted=0 ";
                $beanData = $db->getrow($sql);
            } else {
                $userData['name'] = $userInfo['name'];
                $userData['username'] = $userInfo['email'];
                $userData['password'] = rand(10000, 99999);
                $entity->save($mod, $userData);

                if (isset($entity->beandata['user'])) {
                    $beanData = $entity->beandata['user'];
                }
            }
            if ($beanData) {
                $autheticate->processSession($beanData, $resource);
                return true;
            }
        }

        return false;
    }

    function loginWithUsernameAndPassword($username, $password, $resource = "frontend")
    {
        $autheticate = new Authenticate();
        return $autheticate->login($username, $password, $resource);
    }

    function changePasswordForRole($role, $roleId, $newPassword)
    {
        $entity = lib_entity::getInstance();
        $student = $entity->get($role, $roleId);
        if ($student) {
            $student['password'] = $newPassword;
            $entity->save($role, $student);
            return $entity;
        }
        return false;
    }

    function changePasswordForRoleByUername($role, $userName, $newPassword)
    {
        $sql = "select id from " . $role . " where username='" . $userName . "'";
        $row = lib_database::getInstance()->getrow($sql);
        if ($row) {
            return $this->changePasswordForRole($role, $row['id'], $newPassword);
        }

        return false;
    }
}
?>