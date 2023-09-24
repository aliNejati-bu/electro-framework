<?php


return [
    'lang' => 'fa',
    'app_url' => 'https://my.visitalcard.shop',
    'routes' => [
        'login' => '/auth/login',
        'home' => '/home',
        'forget_password' => '/auth/forget-password',
        'edit_password_forget' => '/auth/re-pass',
        'doRepass' => '/auth/doRe-pass',
        'orders' => '/home/orders',
        'order' => '/home/orders/!-!',
        'order_info' => '/home/orders/!-!/info',
        'order_info_reject' => '/home/orders/!-!/reject',
        'add_tracking' => '/home/orders/!-!/add-tracking',
        'change_order_status' => '/home/orders/!-!/change-status',
        'logout' => '/auth/logout',
        'profile' => '/home/profile',
        'profile_admin' => '/home/profile/!-!',
        'user_profile' => '/users/!-!',
        'delete_user' => '/users/!-!/delete',
        'download_image' => '/download-image',
        'list_of_users' => '/home/users',
        'register_new_order' => '/register',
        'postal_update' => '/home/profile/!-!/postal',
        'changeGroup' => '/home/change-group'
    ],
];