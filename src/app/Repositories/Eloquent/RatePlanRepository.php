<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RatePlanRepositoryInterface;
use App\Models\RatePlan;

class RatePlanRepository implements RatePlanRepositoryInterface
{
    public function all()
    {
        return RatePlan::all();
    }

    public function find(int $id)
    {
        return RatePlan::find($id);
    }

    public function withRelations()
    {
        return RatePlan::with([])->get();
    }

    public function withJoinExample()
    {
        return RatePlan::query()
            ->leftJoin('reservations', 'reservations.RatePlan_id', '=', strtolower('RatePlan') . 's.id')
            ->select(strtolower('RatePlan') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('RatePlan') . 's.id')
            ->get();
    }
}