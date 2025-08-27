<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Models\Review;

class ReviewRepository implements ReviewRepositoryInterface
{
    public function all()
    {
        return Review::all();
    }

    public function find(int $id)
    {
        return Review::find($id);
    }

    public function withRelations()
    {
        return Review::with([])->get();
    }

    public function withJoinExample()
    {
        return Review::query()
            ->leftJoin('reservations', 'reservations.Review_id', '=', strtolower('Review') . 's.id')
            ->select(strtolower('Review') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('Review') . 's.id')
            ->get();
    }
}