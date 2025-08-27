<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\AmenityHotelRepositoryInterface;
use App\Models\Amenity;

class AmenityHotelRepository implements AmenityHotelRepositoryInterface
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
            ->leftJoin('reservations', 'reservations.AmenityHotel_id', '=', strtolower('AmenityHotel') . 's.id')
            ->select(strtolower('AmenityHotel') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('AmenityHotel') . 's.id')
            ->get();
    }
}