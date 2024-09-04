<?php

namespace App\Presenters;


class CountryPresenter extends BasePresenter
{
    public function paginate($models, $sort_by = 'id', $sort_dir = 'asc', $count = null)
    {
        $sort_by = $this->getSortBy($sort_by);
        $sort_dir = $this->getSortDir($sort_dir);
        $models = $models->sortBy($sort_by, SORT_REGULAR, $sort_dir)->values()->all();
        return $this->helper
            ->paginateArray($models, $count ?: $this->getPaginationCount())
            ->appends($this->filterQueryStrings());
    }
}
