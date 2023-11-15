<?php

namespace App\Http\Modules\Products\Repositories;

use App\Http\Modules\Bases\RepositoryBase;
use App\Http\Modules\Products\Models\Product;

class ProductRepository extends  RepositoryBase
{
    public function __construct(
        protected Product $productModel
    ) {
        parent::__construct($this->productModel);
    }

    /**
     * Get List Product
     *
     * @return object
     */
    public function list(): object
    {
        return $this->productModel->select('name', 'price', 'category_id', 'mark_id')
            ->with([
                'category:id,name',
                'mark:id,name',
            ])
            ->get();
    }

    /**
     * Get By Id Product
     *
     * @param integer $id
     * @return Product|null
     */
    public function getById(int $id): ?Product
    {
        return $this->productModel->select('name', 'price', 'category_id', 'mark_id')
            ->with([
                'category:id,name',
                'mark:id,name',
            ])
            ->where('id', $id)->first();
    }
}
