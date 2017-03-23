<?php

use backend\components\AccessPermission;

AccessPermission::access();

$items[] = [
    'url' => ['/site/index'],
    'label' => 'Main Page',
    'icon' => 'home'
];

$items[] = [
    'label' => 'Api',
    'icon' => 'glyphicon glyphicon-send',
    'visible' => AccessPermission::can('indexApi'),
    'url' => ['/api/index']
];

$items[] = [
    'label' => 'Admin',
    'icon' => 'glyphicon glyphicon-user',
    'visible' => AccessPermission::can('indexAdmin'),
    'items' => [
        ['label' => 'Create admin', 'url' => ['/admin/create'], 'icon'=>'glyphicon glyphicon-plus' , 'visible' => AccessPermission::can('createAdmin')],
        ['label' => 'List admin', 'url' => ['/admin/index'] , 'icon'=>'glyphicon glyphicon-list-alt', 'visible' => AccessPermission::can('indexAdmin')],
    ]
];

$items[] = [
    'label' => 'Access Admin',
    'icon' => 'glyphicon glyphicon-lock',
    'visible' => AccessPermission::can('indexRole'),
    'items' => [

        ['label' => 'Assignment', 'icon' => 'glyphicon glyphicon-transfer', 'url' => ['/rbac/assignment']],
        ['label' => 'Role', 'icon' => 'glyphicon glyphicon-book', 'url' => ['/rbac/role']],
        ['label' => 'Permission', 'icon' => 'glyphicon glyphicon-list-alt', 'url' => ['/rbac/permission']],
    ],
];

$items[] = [
    'label' => 'Documentation',
    'icon' => 'glyphicon glyphicon-book',
    'visible' => AccessPermission::can('indexDocument'),
    'items' => [
        ['label' => 'Guide', 'icon'=>'glyphicon glyphicon-list-alt', 'url' => ['/docs/guide/guide-README.html']],
        ['label' => 'Api', 'icon'=>'glyphicon glyphicon-list-alt', 'url' => ['/docs/api/index.html']],
    ],
];

$items[] = [
    'label' => 'Logging',
    'icon' => 'glyphicon glyphicon-folder-open',
    'url' => ['/logs/log'],
    'visible' => AccessPermission::can('indexLog'),
];

return $items;

?>