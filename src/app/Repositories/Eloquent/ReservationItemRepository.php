<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ReservationItemRepositoryInterface;
use App\Models\ReservationItem;

class ReservationItemRepository implements ReservationItemRepositoryInterface
{
    public function all()
    {
        return ReservationItem::all();
    }

    public function find(int $id)
    {
        return ReservationItem::find($id);
    }

    public function withRelations()
    {
        return ReservationItem::with([])->get();
    }

    public function withJoinExample()
    {
        return ReservationItem::query()
            ->leftJoin('reservations', 'reservations.ReservationItem_id', '=', strtolower('ReservationItem') . 's.id')
            ->select(strtolower('ReservationItem') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('ReservationItem') . 's.id')
            ->get();
    }
}