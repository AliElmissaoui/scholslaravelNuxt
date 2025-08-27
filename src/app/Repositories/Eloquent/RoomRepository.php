<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoomRepositoryInterface;
use App\Models\Room;

class RoomRepository implements RoomRepositoryInterface
{
    public function all()
    {
        return Room::all();
    }

    public function find(int $id)
    {
        return Room::find($id);
    }

    public function withRelations()
    {
        return Room::with([])->get();
    }

    public function withJoinExample()
    {
        return Room::query()
            ->leftJoin('reservations', 'reservations.Room_id', '=', strtolower('Room') . 's.id')
            ->select(strtolower('Room') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('Room') . 's.id')
            ->get();
    }
}