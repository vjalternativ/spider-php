<?php

class EmailBufferService
{

    private static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new EmailBufferService();
        }
        return self::$instance;
    }

    public function save($to, $subject, $body, $attachments = array(), $cc = array(), $context = "default")
    {
        $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";

        if (preg_match($pattern, $to)) {
            $entity = lib_entity::getInstance();
            $email = array();
            $email['name'] = $subject;
            $email['description'] = $body;
            $email['context'] = "default";
            $email['email_to'] = $to;
            if ($attachments) {
                $email['attachments'] = json_encode($attachments);
            }
            return $entity->save("email_buffer", $email);
        }
        return false;
    }
}
?>