<?php

namespace App\Repositories\Eloquent;

use App\Models\Test;
use App\Repositories\Contracts\TestRepositoryInterface;

class TestRepository extends BaseRepository implements TestRepositoryInterface
{
    public function __construct(Test $model)
    {
        parent::__construct($model);
    }
}