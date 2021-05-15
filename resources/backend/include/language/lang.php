<?php
$app_list_strings = array(
    'relationship_type_list' => array(
        '1_M' => 'One-To-Many',
        'M_1' => 'Many-To-One'
    ),
    'tabletype_list' => array(
        'basic' => 'Basic',
        'relationship' => 'Relationship',
        'user' => 'User',
        'cstm' => 'Custom',
        'page' => 'Page'
    ),
    'user_type_list' => array(
        'superuser' => 'Super User',
        'admin' => 'Administrator',
        'guest' => 'Guest'
    ),
    'role_access_list' => array(
        'no' => 'no',
        'yes' => 'yes'
    ),
    'test_list' => array(
        'a' => 'A',
        'b' => 'B'
    ),
    'layout_param_list' => array(
        'row' => 'Row',
        'hr' => 'HR'
    ),
    'status_list' => array(
        'Active' => 'Active',
        'Inactive' => 'Inactive',
        '' => ''
    ),
    'page_list' => array(
        'home' => 'home',
        'flight_page' => 'flight_page'
    ),
    'position' => array(
        'middle' => 'middle',
        'bottom' => 'bottom',
        'bottomline1' => 'bottomline1',
        'slider' => 'slider'
    ),
    'pax_type' => array(
        'adult' => 'adult',
        'child' => 'child',
        'infant' => 'infant'
    ),
    'title' => array(
        'mr' => 'mr',
        'ms' => 'ms',
        'mrs' => 'mrs',
        'miss' => 'miss',
        'mstr' => 'mstr'
    ),
    'trip_type_list' => array(
        1 => 'One Way',
        2 => 'Return Way',
        3 => 'Multistop'
    ),
    'runs_on_list' => array(
        "all" => "all",
        "new" => "new",
        "mod" => "modified"
    )
);

lib_datawrapper::getInstance()->set("app_list_strings_list", $app_list_strings);
