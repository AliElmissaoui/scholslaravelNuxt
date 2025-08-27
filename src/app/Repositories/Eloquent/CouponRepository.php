<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CouponRepositoryInterface;
use App\Models\Coupon;

class CouponRepository implements CouponRepositoryInterface
{
    public function all()
    {
        return Coupon::all();
    }

    public function find(int $id)
    {
        return Coupon::find($id);
    }

    public function withRelations()
    {
        return Coupon::with([])->get();
    }

    public function withJoinExample()
    {
        return Coupon::query()
            ->leftJoin('reservations', 'reservations.Coupon_id', '=', strtolower('Coupon') . 's.id')
            ->select(strtolower('Coupon') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('Coupon') . 's.id')
            ->get();
    }
}