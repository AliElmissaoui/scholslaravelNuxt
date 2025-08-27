<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\AmenityRepositoryInterface;
use App\Models\Amenity;

class AmenityRepository implements AmenityRepositoryInterface
{
    public function all()
    {
        return Amenity::all();
    }

    public function find(int $id)
    {
        return Amenity::find($id);
    }

    public function withRelations()
    {
        return Amenity::with([])->get();
    }

    public function withJoinExample()
    {
        return Amenity::query()
            ->leftJoin('reservations', 'reservations.Amenity_id', '=', strtolower('Amenity') . 's.id')
            ->select(strtolower('Amenity') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('Amenity') . 's.id')
            ->get();
    }
}