<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoomCalendarRepositoryInterface;
use App\Models\RoomCalendar;

class RoomCalendarRepository implements RoomCalendarRepositoryInterface
{
    public function all()
    {
        return RoomCalendar::all();
    }

    public function find(int $id)
    {
        return RoomCalendar::find($id);
    }

    public function withRelations()
    {
        return RoomCalendar::with([])->get();
    }

    public function withJoinExample()
    {
        return RoomCalendar::query()
            ->leftJoin('reservations', 'reservations.RoomCalendar_id', '=', strtolower('RoomCalendar') . 's.id')
            ->select(strtolower('RoomCalendar') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('RoomCalendar') . 's.id')
            ->get();
    }
}