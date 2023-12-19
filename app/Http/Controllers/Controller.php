<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function breadcrumb($pages, $current, $dashboard = 1)
    {
        $breadcrumb = ['pages' => [], 'current' => $current];
        if ($dashboard) {
            array_push($breadcrumb['pages'], ['title' => __('user.dashboard'), 'route' => route('admin.dashboard')]);
        }
        foreach ($pages as $page) {
            array_push($breadcrumb['pages'], ['title' => $page['title'], 'route' => $page['route']]);
        }
        return $breadcrumb;
    }
    /**
     * for store, update, delete.
     *
     * @param string $msg
     * @param string|null $url
     * @param string $type
     * @param array $data
     * @param null $view
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function returnCrudData(string $msg, string $url = null, string $type = 'success', $data = [], $view = null)
    {
        if (request()->expectsJson()) {
//            $all = ['message' => $msg, 'url' => $url, 'data' => $data, 'status' => $type == 'success', 'view' => $view];
//            return response()->json($all)->setEncodingOptions('JSON_HEX_QUOT');
            return response()->json(['message' => $msg, 'url' => $url, 'data' => $data, 'status' => $type == 'success', 'view' => $view], $type == 'error' ? 400 : 200);
        }

        flash()->{$type}($msg);
        return $url ? redirect($url) : back();
    }

    /**
     * filter out empty query strings.
     */
    protected function filterQueryStrings()
    {
        return array_filter(request()->query());
    }

    protected function hoursList()
    {
        $startOfDay = Carbon::now()->startOfDay();

        // Create a Carbon instance for the end of the day
        $endOfDay = Carbon::now()->endOfDay();

        // Generate an array of hours in the day
        $hoursList = [];

        // Loop through the hours of the day and populate the array
        for ($hour = clone $startOfDay; $hour <= $endOfDay; $hour->addHour()) {
            $hoursList[] = $hour->format('H'); // Format the hour (24-hour format with minutes)
        }

        return $hoursList;
    }
}
