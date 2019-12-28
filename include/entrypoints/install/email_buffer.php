<?php 

$tableInfoData = array (
  'fields' => 
  array (
    'email_to' => 
    array (
      'name' => 'email_to',
      'type' => 'text',
    ),
    'email_cc' => 
    array (
      'name' => 'email_cc',
      'type' => 'text',
    ),
    'email_bcc' => 
    array (
      'name' => 'email_bcc',
      'type' => 'text',
    ),
    'email_header' => 
    array (
      'name' => 'email_header',
      'type' => 'varchar',
      'len' => '255',
    ),
    'email_body' => 
    array (
      'name' => 'email_body',
      'type' => 'text',
    ),
    'context' => 
    array (
      'name' => 'context',
      'type' => 'relate',
      'rmodule' => 'outbound_email_context',
      'len' => '36',
    ),
    'is_sent_successfully' => 
    array (
      'name' => 'is_sent_successfully',
      'type' => 'checkbox',
    ),
    'send_attempts' => 
    array (
      'name' => 'send_attempts',
      'type' => 'int',
    ),
    'sending_error' => 
    array (
      'name' => 'sending_error',
      'type' => 'varchar',
      'len' => '255',
    ),
    'last_attempt' => 
    array (
      'name' => 'last_attempt',
      'type' => 'datetime',
    ),
    'attachments' => 
    array (
      'name' => 'attachments',
      'type' => 'text',
    ),
    'embedded_images' => 
    array (
      'name' => 'embedded_images',
      'type' => 'varchar',
      'len' => '1024',
    ),
    'sendfrom' => 
    array (
      'name' => 'sendfrom',
      'type' => 'varchar',
      'len' => '255',
    ),
  ),
  'metadata' => 
  array (
    'listview' => 
    array (
      'email_to' => 
      array (
        'name' => 'email_to',
        'type' => 'text',
      ),
      'is_sent_successfully' => 
      array (
        'name' => 'is_sent_successfully',
        'type' => 'checkbox',
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
              'name' => 'description',
              'type' => 'text',
              'label' => 'LBL_DESCRIPTION',
            ),
            'gridsize' => '12',
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
              'name' => 'email_to',
              'type' => 'text',
            ),
            'gridsize' => '6',
          ),
          1 => 
          array (
            'field' => 
            array (
              'name' => 'context',
              'type' => 'relate',
              'rmodule' => 'outbound_email_context',
              'len' => '36',
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
              'name' => 'is_sent_successfully',
              'type' => 'checkbox',
            ),
            'gridsize' => '6',
          ),
          1 => 
          array (
            'field' => 
            array (
              'name' => 'last_attempt',
              'type' => 'datetime',
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
              'name' => 'sending_error',
              'type' => 'varchar',
              'len' => '255',
            ),
            'gridsize' => '6',
          ),
          1 => 
          array (
            'field' => 
            array (
              'name' => 'sendfrom',
              'type' => 'varchar',
              'len' => '255',
            ),
            'gridsize' => '6',
          ),
        ),
      ),
    ),
  ),
  'type' => 'basic',
  'label' => 'email_buffer',
);

global $entity;

$entity->createEntity("email_buffer",$tableInfoData);
?>