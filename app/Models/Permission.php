<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as LaravelPermission;

class Permission extends LaravelPermission
{
    protected $guard_name = 'web';

}
