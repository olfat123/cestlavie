<?php

namespace App\Acme;

use App\Models\HomeConfig;
use App\Models\Page;
use App\Models\SupportConfig;
use Carbon\Carbon;
use URL;
use Blade;
use Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Core
{
    /**
     * [caching description].
     *
     * @return [type] [description]
     */
    public function caching()
    {
    }

    /**
     * custome facade functions.
     *
     * @return [type] [description]
     */
    public function macros()
    {
        $this->blade();
        $this->route();
        $this->url();
        $this->eloquent();
        $this->validation();
    }

    protected function eloquent()
    {
        // https://laracasts.com/discuss/channels/eloquent/pluck-from-a-nested-collection?page=1#reply=447477
        Collection::macro('pluckSubRelation', function ($field) {
            $arr = explode('.', $field);
            $toGet = array_pop($arr);

            $res = $this;
            foreach ($arr as $relation) {
                $res = $res->pluck($relation)->flatten();
            }

            return $res->pluck($toGet);
        });

        // https://scotch.io/tutorials/understanding-and-using-laravel-eloquent-macros#toc-a-quick-example
        HasMany::macro('toHasOne', function () {
            return new HasOne(
                $this->getQuery(),
                $this->getParent(),
                $this->foreignKey,
                $this->localKey
            );
        });
    }

    protected function blade()
    {
        Blade::directive('dd', function ($param) {
            return "<?php dd($param); ?>";
        });

        Blade::if('dev', function () {
            return app()->environment('local');
        });
    }

    protected function route()
    {
        // https://laracasts.com/discuss/channels/laravel/setting-route-namespace-to-outside-the-apphttpcontroller-directorynamespace/replies/432789
        Route::macro('setGroupNamespace', function ($namesapce = null) {
            // Get last groupStack data and hard change the namespace value
            $lastGroupStack = array_pop($this->groupStack);

            if ($lastGroupStack !== null) {
                Arr::set($lastGroupStack, 'namespace', $namesapce);
                $this->groupStack[] = $lastGroupStack;
            }

            return $this;
        });
    }

    protected function url()
    {
        // same as "Route::is()" but better
        URL::macro('is', function ($route_name, $params = null) {
            return $params
                ? request()->url() == route($route_name, $params)
                : request()->url() == route($route_name);
        });

        URL::macro('has', function ($needle) {
            return Str::contains($this->current(), $needle);
        });
    }

    protected function validation()
    {
        // make sure array has at least the number of items
        // ex.arrayMinItems:2
        Validator::extend('arrayMinItems', function ($attribute, $value, $parameters, $validator) {
            $validator->addReplacer('arrayMinItems', function ($message, $v_attribute, $rule, $parameters) {
                return str_replace(':value', $parameters[0], $message);
            });

            return count(array_filter($value)) >= $parameters[0];
        });
        Validator::extend(
            'recaptcha',
            'App\\Rules\\ReCaptcha@validate'
        );
    }

    /**
     * share date across all views.
     *
     * @return [type] [description]
     */
    public function viewShares()
    {
        view()->share('helper', $this);
        view()->share('avatarDef', asset(config('team.sysconfig.default-avatar')));
        view()->share('adminAvatarDef', asset(config('team.sysconfig.default-admin-avatar')));
    }

    /**
     * viewComposers.
     */
    public function viewComposers()
    {
        view()->composer('*', function ($view) {
            $view->with([
                'authUser' => auth()->user(),
                'maxImageSize' => env('IMAGE_MAX_SIZE'),
            ]);
        });
    }

    /* -------------------------------------------------------------------------- */
    /*                                   helpers                                  */
    /* -------------------------------------------------------------------------- */

    /**
     * getCurrencyNameFor.
     *
     * @param mixed $country
     * @param mixed $type
     */
    public function getCurrencyNameFor($country, $type = 'short')
    {
        $cur = collect(country($country)->getCurrency());

        return $type == 'short' ? $cur['iso_4217_code'] : $cur['iso_4217_name'];
    }

    /**
     * currency.
     *
     * @param mixed $money
     * @param mixed $decimals
     * @param mixed $decimalpoint
     * @param mixed $separator
     * @param mixed '
     */
    public function currency($money, $decimals = 0, $decimalpoint = '.', $separator = ',')
    {
        return number_format($money, $decimals, $decimalpoint, $separator);
    }


    /**
     * addToCurrentQS.
     *
     * @param mixed $arr
     */
    public function addToCurrentQS($arr)
    {
        return request()->fullUrlWithQuery(array_merge(request()->query(), $arr));
    }

    /**
     * defaultDateFormatter.
     *
     * @param mixed $date
     */
    public function defaultDateFormatter($date)
    {
        return Carbon::parse($date)->format('l, F j, Y');
    }

    /**
     * getColorForStatus.
     *
     * @param mixed $list
     * @param mixed $name
     */
    public function getColorForStatus($list, $order)
    {
        return $list->firstWhere('order', $order)->color;
    }

    /**
     * paginate array or collection.
     *
     * @param array|Collection $items
     * @param int $perPage
     * @param int $page
     *
     * @return LengthAwarePaginator
     */
    public function paginateArray($items, $perPage = 15, $page = null)
    {
        $pageName = 'page';
        $page = $page ?: (Paginator::resolveCurrentPage($pageName) ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator(
            $items->forPage($page, $perPage)->values(),
            $items->count(),
            $perPage,
            $page,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]
        );
    }

    

}
