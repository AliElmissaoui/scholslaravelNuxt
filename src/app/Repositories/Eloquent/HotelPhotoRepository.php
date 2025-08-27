<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\HotelPhotoRepositoryInterface;
use App\Models\HotelPhoto;

class HotelPhotoRepository implements HotelPhotoRepositoryInterface
{
    public function all()
    {
        return HotelPhoto::all();
    }

    public function find(int $id)
    {
        return HotelPhoto::find($id);
    }

    public function withRelations()
    {
        return HotelPhoto::with([])->get();
    }

    public function withJoinExample()
    {
        return HotelPhoto::query()
            ->leftJoin('reservations', 'reservations.HotelPhoto_id', '=', strtolower('HotelPhoto') . 's.id')
            ->select(strtolower('HotelPhoto') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('HotelPhoto') . 's.id')
            ->get();
    }
}