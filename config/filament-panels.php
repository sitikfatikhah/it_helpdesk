<?php

return [

    'shield_resource' => [
        // ... existing config
    ],

    'auth' => [
        'pages' => [
            'login' => \App\Filament\Auth\Login::class,
        ],
    ],

    'auth_provider_model' => [
        'fqcn' => 'App\\Models\\User',
    ],

    'super_admin' => [
        'enabled' => true,
        'name' => 'super_admin',
        'define_via_gate' => false,
        'intercept_gate' => 'before',
    ],

    'panel_user' => [
        'enabled' => true,
        'name' => 'panel_user',
    ],

];
