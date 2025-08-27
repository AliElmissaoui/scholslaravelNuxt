<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoleUserRepositoryInterface;
use App\Models\RoleUser;

class RoleUserRepository implements RoleUserRepositoryInterface
{
    public function all()
    {
        return RoleUser::all();
    }

    public function find(int $id)
    {
        return RoleUser::find($id);
    }

    public function withRelations()
    {
        return RoleUser::with([])->get();
    }

    public function withJoinExample()
    {
        return RoleUser::query()
            ->leftJoin('reservations', 'reservations.RoleUser_id', '=', strtolower('RoleUser') . 's.id')
            ->select(strtolower('RoleUser') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('RoleUser') . 's.id')
            ->get();
    }
}