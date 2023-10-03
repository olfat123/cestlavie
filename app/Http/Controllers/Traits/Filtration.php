<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

trait Filtration
{
    protected function filterData($request, $collection)
    {
       
        
        // Common
        $title = str_replace('"', '\"', $request->q);
        $title = str_replace("'", "\'", $title);
        $title = str_replace("%", "\'", $title);
        
       
        $collection->when($title, function ($query) use ($title) {
            return $query->where(function ($query) use ($title) {
                $query->whereRaw('title like "%' . strtolower($title) . '%"');    
            });
        });
        // dd($collection->toSql());

        return $collection;
    }

}
