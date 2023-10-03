<?php

return [
    'default-avatar' => 'images/avatars/user-default.jpg',
    'default-admin-avatar' => 'assets/admin/img/avatars/user.png',
    'image_max_size' => 1024 * env('IMAGE_MAX_SIZE'),
    'pagination' => [
        'default' => 10,
        'api' => 9,
        'grid' => 15,
    ],
    
    'user_lang_list' => [
        'ar' => ['name' => 'Arabic', 'native' => 'العربية'],
        'en' => ['name' => 'English', 'native' => 'English'],
    ],
    'languages' => [
        'English',
        'Arabic',
        'French',
        'Spanish',
        'Dutch',
        'German',
        'Italian',
        'Russian',
    ],
    
];
