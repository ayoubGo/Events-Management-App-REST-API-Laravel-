<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as EloquentBuider;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder as QueryBuider;

trait CanLoadRelationships{

    public function loadRealationships(
        Model|EloquentBuider|QueryBuider|HasMany $for,?array $relations = null
    ): Model|EloquentBuider|QueryBuider|HasMany{

        $relations = $relations ?? $this->relations ?? [];

        foreach ($relations as $relation) {
            $for->when(
                $this->shouldIncludeRelation($relation),
                fn($q) => $for instanceof Model ? $for->load($relation) : $q->with($relation)
            );
        }
        return $for;
    }



    protected function shouldIncludeRelation(string $relation): bool{

        $include = request()->query("include");

        if(!$include){
            return false;
        }
        $relations = array_map("trim",explode(",", $include));
        return in_array($relation, $relations); // this return a boolean in the relation exist in the relations
    }

}
