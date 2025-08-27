<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Models\Payment;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function all()
    {
        return Payment::all();
    }

    public function find(int $id)
    {
        return Payment::find($id);
    }

    public function withRelations()
    {
        return Payment::with([])->get();
    }

    public function withJoinExample()
    {
        return Payment::query()
            ->leftJoin('reservations', 'reservations.Payment_id', '=', strtolower('Payment') . 's.id')
            ->select(strtolower('Payment') . 's.*')
            ->selectRaw('COUNT(reservations.id) as reservations_count')
            ->groupBy(strtolower('Payment') . 's.id')
            ->get();
    }
}