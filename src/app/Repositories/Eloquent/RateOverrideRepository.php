<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RateOverrideRepositoryInterface;
use App\Models\RateOverride;

class RateOverrideRepository implements RateOverrideRepositoryInterface
{
    public function all()
    {
        return RateOverride::all();
    }

    public function find(int $id)
    {
        return RateOverride::find($id);
    }

    public function withRelations()
    {
        return RateOverride::with([])->get();
    }

    public function withJoinExample()
    {
        return RateOverride::query()
            ->leftJoin('reservations', 'reservations.RateOverride_id', '=', strtolower('RateOverride') . 's.id')
            ->select(strtolower('RateOverride') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('RateOverride') . 's.id')
            ->get();
    }
}