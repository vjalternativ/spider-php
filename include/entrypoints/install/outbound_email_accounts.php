<?php

$tableInfoData = array (
    'fields' =>
    array (
        'user_name' =>
        array (
            'name' => 'user_name',
            'type' => 'varchar',
            'len' => '255',
        ),
        'mail_password' =>
        array (
            'name' => 'mail_password',
            'type' => 'varchar',
            'len' => '255',
        ),
        'mail_server' =>
        array (
            'name' => 'mail_server',
            'type' => 'varchar',
            'len' => '255',
        ),
        'mail_port' =>
        array (
            'name' => 'mail_port',
            'type' => 'int',
        ),
        'mail_ssl' =>
        array (
            'name' => 'mail_ssl',
            'type' => 'checkbox',
        ),
        'from_name' =>
        array (
            'name' => 'from_name',
            'type' => 'varchar',
            'len' => '255',
        ),
        'from_address' =>
        array (
            'name' => 'from_address',
            'type' => 'varchar',
            'len' => '255',
        ),
        'reply_to_name' =>
        array (
            'name' => 'reply_to_name',
            'type' => 'varchar',
            'len' => '255',
        ),
        'reply_to_address' =>
        array (
            'name' => 'reply_to_address',
            'type' => 'varchar',
            'len' => '255',
        ),
        'used_today' =>
        array (
            'name' => 'used_today',
            'type' => 'int',
        ),
        'date_last_used' =>
        array (
            'name' => 'date_last_used',
            'type' => 'date',
        ),
        'maxlimit' =>
        array (
            'name' => 'maxlimit',
            'type' => 'int',
        ),
    ),
    'metadata' =>
    array (
        'listview' =>
        array (
            'user_name' =>
            array (
                'name' => 'user_name',
                'type' => 'varchar',
                'len' => '255',
            ),
            'mail_server' =>
            array (
                'name' => 'mail_server',
                'type' => 'varchar',
                'len' => '255',
            ),
        ),
        'editview' =>
        array (
            1 =>
            array (
                'type' => 'row',
                'fields' =>
                array (
                    0 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'user_name',
                            'type' => 'varchar',
                            'len' => '255',
                        ),
                        'gridsize' => '6',
                    ),
                    1 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'mail_password',
                            'type' => 'varchar',
                            'len' => '255',
                        ),
                        'gridsize' => '6',
                    ),
                ),
            ),
            2 =>
            array (
                'type' => 'row',
                'fields' =>
                array (
                    0 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'mail_server',
                            'type' => 'varchar',
                            'len' => '255',
                        ),
                        'gridsize' => '6',
                    ),
                    1 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'mail_port',
                            'type' => 'int',
                        ),
                        'gridsize' => '6',
                    ),
                ),
            ),
            3 =>
            array (
                'type' => 'row',
                'fields' =>
                array (
                    0 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'from_name',
                            'type' => 'varchar',
                            'len' => '255',
                        ),
                        'gridsize' => '6',
                    ),
                    1 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'from_address',
                            'type' => 'varchar',
                            'len' => '255',
                        ),
                        'gridsize' => '6',
                    ),
                ),
            ),
            4 =>
            array (
                'type' => 'row',
                'fields' =>
                array (
                    0 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'reply_to_name',
                            'type' => 'varchar',
                            'len' => '255',
                        ),
                        'gridsize' => '6',
                    ),
                    1 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'reply_to_address',
                            'type' => 'varchar',
                            'len' => '255',
                        ),
                        'gridsize' => '6',
                    ),
                ),
            ),
            5 =>
            array (
                'type' => 'row',
                'fields' =>
                array (
                    0 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'maxlimit',
                            'type' => 'int',
                        ),
                        'gridsize' => '6',
                    ),
                    1 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'mail_ssl',
                            'type' => 'checkbox',
                        ),
                        'gridsize' => '6',
                    ),
                ),
            ),
        ),
        'detailview' =>
        array (
            1 =>
            array (
                'type' => 'row',
                'fields' =>
                array (
                    0 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'user_name',
                            'type' => 'varchar',
                            'len' => '255',
                        ),
                        'gridsize' => '6',
                    ),
                ),
            ),
            2 =>
            array (
                'type' => 'row',
                'fields' =>
                array (
                    0 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'mail_server',
                            'type' => 'varchar',
                            'len' => '255',
                        ),
                        'gridsize' => '6',
                    ),
                    1 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'mail_port',
                            'type' => 'int',
                        ),
                        'gridsize' => '6',
                    ),
                ),
            ),
            3 =>
            array (
                'type' => 'row',
                'fields' =>
                array (
                    0 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'from_name',
                            'type' => 'varchar',
                            'len' => '255',
                        ),
                        'gridsize' => '6',
                    ),
                    1 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'from_address',
                            'type' => 'varchar',
                            'len' => '255',
                        ),
                        'gridsize' => '6',
                    ),
                ),
            ),
            4 =>
            array (
                'type' => 'row',
                'fields' =>
                array (
                    0 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'reply_to_name',
                            'type' => 'varchar',
                            'len' => '255',
                        ),
                        'gridsize' => '6',
                    ),
                    1 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'reply_to_address',
                            'type' => 'varchar',
                            'len' => '255',
                        ),
                        'gridsize' => '6',
                    ),
                ),
            ),
            5 =>
            array (
                'type' => 'row',
                'fields' =>
                array (
                    0 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'used_today',
                            'type' => 'int',
                        ),
                        'gridsize' => '6',
                    ),
                    1 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'date_last_used',
                            'type' => 'date',
                        ),
                        'gridsize' => '6',
                    ),
                ),
            ),
            6 =>
            array (
                'type' => 'row',
                'fields' =>
                array (
                    0 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'mail_ssl',
                            'type' => 'checkbox',
                        ),
                        'gridsize' => '6',
                    ),
                    1 =>
                    array (
                        'field' =>
                        array (
                            'name' => 'maxlimit',
                            'type' => 'int',
                        ),
                        'gridsize' => '6',
                    ),
                ),
            ),
        ),
    ),
    'type' => 'basic',
    'label' => 'outbound_email_accounts',
);

global $entity;

$entity->createEntity("outbound_email_accounts",$tableInfoData);
$entity->createRelationship("outbound_email_context","outbound_email_accounts","1_M");
?>