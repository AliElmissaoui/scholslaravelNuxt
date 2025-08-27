<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Models\Country;

class CountryRepository implements CountryRepositoryInterface
{
    public function all()
    {
        return Country::all();
    }

    public function find(int $id)
    {
        return Country::find($id);
    }

    public function withRelations()
    {
        return Country::with([])->get();
    }

    public function withJoinExample()
    {
        return Country::query()
            ->leftJoin('reservations', 'reservations.Country_id', '=', strtolower('Country') . 's.id')
            ->select(strtolower('Country') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('Country') . 's.id')
            ->get();
    }
}