<?php


namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Model ;
use Illuminate\Database\Eloquent\Builder as EloquentBuider;
use Illuminate\Database\Query\Builder as QueryBuider;

trait CanLoadRelationships{

    public function loadRealationships(
        Model|EloquentBuider|QueryBuider $for,array $relations
    ){

    }
}
