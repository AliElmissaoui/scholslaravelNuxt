<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoomPhotoRepositoryInterface;
use App\Models\RoomPhoto;

class RoomPhotoRepository implements RoomPhotoRepositoryInterface
{
    public function all()
    {
        return RoomPhoto::all();
    }

    public function find(int $id)
    {
        return RoomPhoto::find($id);
    }

    public function withRelations()
    {
        return RoomPhoto::with([])->get();
    }

    public function withJoinExample()
    {
        return RoomPhoto::query()
            ->leftJoin('reservations', 'reservations.RoomPhoto_id', '=', strtolower('RoomPhoto') . 's.id')
            ->select(strtolower('RoomPhoto') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('RoomPhoto') . 's.id')
            ->get();
    }
}