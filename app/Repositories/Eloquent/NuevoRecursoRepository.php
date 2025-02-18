<?php
namespace app\Repositories\Eloquent;
use app\Models\NuevoRecurso;
use app\Repositories\Contracts\NuevoRecursoRepositoryInterface;


class NuevoRecursoRepository extends BaseRepository implements NuevoRecursoRepositoryInterface{
    public function __construct(NuevoRecurso $model)
    {
        parent::__construct($model);
    }
}