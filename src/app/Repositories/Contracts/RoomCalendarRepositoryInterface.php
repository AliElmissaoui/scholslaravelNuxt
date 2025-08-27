<?php

namespace App\Repositories\Contracts;

interface RoomCalendarRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function withRelations();
    public function withJoinExample();
}