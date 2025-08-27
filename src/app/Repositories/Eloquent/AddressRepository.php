<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\AddressRepositoryInterface;
use App\Models\Addres;

class AddressRepository implements AddressRepositoryInterface
{
    public function all()
    {
        return Addres::all();
    }

    public function find(int $id)
    {
        return Addres::find($id);
    }

    public function withRelations()
    {
        return Addres::with([])->get();
    }

    public function withJoinExample()
    {
        return Addres::query()
            ->leftJoin('reservations', 'reservations.Addres_id', '=', strtolower('Addres') . 's.id')
            ->select(strtolower('Addres') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('Addres') . 's.id')
            ->get();
    }
}