<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/admin/sections/update-status', '/admin/categories/update-status',
        '/admin/subcategories/update-status', 'admin/subcategories/server_side_data'
    ];
}
