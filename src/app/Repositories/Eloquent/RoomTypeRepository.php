<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoomTypeRepositoryInterface;
use App\Models\RoomType;

class RoomTypeRepository implements RoomTypeRepositoryInterface
{
    public function all()
    {
        return RoomType::all();
    }

    public function find(int $id)
    {
        return RoomType::find($id);
    }

    public function withRelations()
    {
        return RoomType::with([])->get();
    }

    public function withJoinExample()
    {
        return RoomType::query()
            ->leftJoin('reservations', 'reservations.RoomType_id', '=', strtolower('RoomType') . 's.id')
            ->select(strtolower('RoomType') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('RoomType') . 's.id')
            ->get();
    }
}