<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CityRepositoryInterface;
use App\Models\City;

class CityRepository implements CityRepositoryInterface
{
    public function all()
    {
        return City::all();
    }

    public function find(int $id)
    {
        return City::find($id);
    }

    public function withRelations()
    {
        return City::with([])->get();
    }

    public function withJoinExample()
    {
        return City::query()
            ->leftJoin('reservations', 'reservations.City_id', '=', strtolower('City') . 's.id')
            ->select(strtolower('City') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('City') . 's.id')
            ->get();
    }
}