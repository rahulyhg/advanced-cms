<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'permissions' => 'c,r,u,d',
            'profile' => 'r,u',
            'user-to-roles' => 'as',
            'role-to-permissions' => 'as',
            'acl-dashboard' => 'ac',
        ],
        'administrator' => [
            'users' => 'r,u',
            'profile' => 'r,u',
            'acl-dashboard' => 'ac',
        ],
        'user' => [
            'profile' => 'r,u'
        ],
    ],
    
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'as' => 'assign',
        'ac' => 'access',
    ]
];
