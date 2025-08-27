<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function all()
    {
        return Role::all();
    }

    public function find(int $id)
    {
        return Role::find($id);
    }

    public function withRelations()
    {
        return Role::with([])->get();
    }

    public function withJoinExample()
    {
        return Role::query()
            ->leftJoin('reservations', 'reservations.Role_id', '=', strtolower('Role') . 's.id')
            ->select(strtolower('Role') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('Role') . 's.id')
            ->get();
    }
}