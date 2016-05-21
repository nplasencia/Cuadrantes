<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Entities\Brand;
use Cuadrantes\Commons\BrandContract;

class BrandRepository extends BaseRepository {
    
    public function getEntity() {
        return new Brand();
    }

    public function getAll() {
        return $this->newQuery()->orderBy(BrandContract::NAME)->get();
    }
}