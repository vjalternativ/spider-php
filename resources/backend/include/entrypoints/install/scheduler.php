<?php 

$tableInfoData = array (
  'fields' => 
  array (
    'path' => 
    array (
      'name' => 'path',
      'type' => 'varchar',
      'len' => '255',
    ),
    'inminute' => 
    array (
      'name' => 'inminute',
      'type' => 'int',
    ),
    'jobclass' => 
    array (
      'name' => 'jobclass',
      'type' => 'varchar',
      'len' => '255',
    ),
    'status' => 
    array (
      'name' => 'status',
      'type' => 'enum',
      'options' => 'status_list',
      'len' => '255',
    ),
    'jobstatus' => 
    array (
      'name' => 'jobstatus',
      'type' => 'varchar',
      'len' => '255',
    ),
  ),
  'metadata' => 
  array (
    'listview' => 
    array (
      'status' => 
      array (
        'name' => 'status',
        'type' => 'enum',
        'options' => 'status_list',
        'len' => '255',
      ),
      'jobstatus' => 
      array (
        'name' => 'jobstatus',
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
              'name' => 'path',
              'type' => 'varchar',
              'len' => '255',
            ),
            'gridsize' => '6',
          ),
          1 => 
          array (
            'field' => 
            array (
              'name' => 'inminute',
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
              'name' => 'jobclass',
              'type' => 'varchar',
              'len' => '255',
            ),
            'gridsize' => '6',
          ),
          1 => 
          array (
            'field' => 
            array (
              'name' => 'status',
              'type' => 'enum',
              'options' => 'status_list',
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
              'name' => 'jobstatus',
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
  'label' => 'scheduler',
);

global $entity;

$entity->createEntity("scheduler",$tableInfoData);
?>