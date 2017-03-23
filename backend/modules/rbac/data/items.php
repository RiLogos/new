<?php
return [
    //Admin controller
    'indexAdmin' => [
        'type' => 2,
        'description' => 'Show all system User'
    ],
    'createAdmin' => [
        'type' => 2,
        'description' => 'Add new User'
    ],
    'updateAdmin' => [
        'type' => 2,
        'description' => 'Edit User profile'
    ],
    'deleteAdmin' => [
        'type' => 2,
        'description' => 'Delete User profile'
    ],
    'viewAdmin' => [
        'type' => 2,
        'description' => 'View User profile'
    ],
    'statusAdmin' => [
        'type' => 2,
        'description' => 'Change status User'
    ],

    //Assignment controller
    'indexAssignment' => [
        'type' => 2,
        'description' => 'Assignment of rules and users'
    ],
    'change-assignmentAssignment' => [
        'type' => 2,
        'description' => 'Relation of role and user'
    ],
    //Role controller
    'indexRole' => [
        'type' => 2,
        'description' => 'Roles overview'
    ],
    'createRole' => [
        'type' => 2,
        'description' => 'Create role'
    ],
    'updateRole' => [
        'type' => 2,
        'description' => 'Edit role'
    ],
    'deleteRole' => [
        'type' => 2,
        'description' => 'Delete role'
    ],
    'viewRole' => [
        'type' => 2,
        'description' => 'View role'
    ],
    //Permission controller
    'indexPermission' => [
        'type' => 2,
        'description' => 'Permissions overview'
    ],
    'createPermission' => [
        'type' => 2,
        'description' => 'Create permission'
    ],
    'updatePermission' => [
        'type' => 2,
        'description' => 'Edit permission'
    ],
    'deletePermission' => [
        'type' => 2,
        'description' => 'Delete permission'
    ],
    'viewPermission' => [
        'type' => 2,
        'description' => 'View permission'
    ],
    'change-permissionPermission' => [
        'type' => 2,
        'description' => 'Change permissions for role'
    ],
    //Log controller
    'indexLog' => [
        'type' => 2,
        'description' => 'System logging'
    ],
    'viewLog' => [
        'type' => 2,
        'description' => 'View logs'
    ],
    'deleteLog' => [
        'type' => 2,
        'description' => 'Delete logs'
    ],
    //Generate controller
    'importGenerate' => [
        'type' => 2,
        'description' => 'Import rules'
    ],
    'exportGenerate' => [
        'type' => 2,
        'description' => 'Export rules'
    ],
    //Default controller
    'toolbarDefault' => [
        'type' => 2,
        'description' => 'Show debug panel'
    ],

    //Document controller
    'indexDocument' => [
        'type' => 2,
        'description' => 'Show documentation'
    ],

    'Admin' => [
        'type' => 1,
        'description' => 'Administrator',
        'children' => [
            //Admin controller
            'indexAdmin',
            'createAdmin',
            'updateAdmin',
            'viewAdmin',
            'deleteAdmin',
            'statusAdmin',

            //Rbac controller
            'indexAssignment',
            'change-assignmentAssignment',
            'indexRole',
            'createRole',
            'updateRole',
            'viewRole',
            'deleteRole',
            'indexPermission',
            'createPermission',
            'updatePermission',
            'viewPermission',
            'deletePermission',
            'change-permissionPermission',
            'importGenerate',
            'exportGenerate',

            //Log controller
            'indexLog',
            'viewLog',
            'deleteLog',

            //Toolbar controller
            'toolbarDefault',
            //Document controller
            'indexDocument',
        ]
    ],
];