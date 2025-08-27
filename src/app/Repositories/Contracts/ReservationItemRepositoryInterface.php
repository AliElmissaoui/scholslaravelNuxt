<?php

namespace App\Repositories\Contracts;

interface ReservationItemRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function withRelations();
    public function withJoinExample();
}