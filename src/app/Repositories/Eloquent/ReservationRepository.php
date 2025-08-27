<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ReservationRepositoryInterface;
use App\Models\Reservation;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function all()
    {
        return Reservation::all();
    }

    public function find(int $id)
    {
        return Reservation::find($id);
    }

    public function withRelations()
    {
        return Reservation::with([])->get();
    }

    public function withJoinExample()
    {
        return Reservation::query()
            ->leftJoin('reservations', 'reservations.Reservation_id', '=', strtolower('Reservation') . 's.id')
            ->select(strtolower('Reservation') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('Reservation') . 's.id')
            ->get();
    }
}