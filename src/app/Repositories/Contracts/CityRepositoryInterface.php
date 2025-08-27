<?php

namespace App\Repositories\Contracts;

interface CityRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function withRelations();
    public function withJoinExample();
}