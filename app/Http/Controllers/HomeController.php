<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Book;
use App\Models\ContactData;
use App\Models\Course;
use App\Models\Employee;
use App\Models\HomeConfigs;
use App\Models\Service;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome');
    }
    public function dashboard()
    {
        return view('pages.dashboard.index', [
            'breadcrumb' => $this->breadcrumb([], 'Dashboard', false),
            'customers_count' => User::count(),
        ]);
    }
    public function profile()
    {
        return view('pages.profile', [
            'breadcrumb' => $this->breadcrumb([], 'Edit Profile')
        ]);
    }
}
