<?php

namespace App\Http\Modules\Marks\Repositories;

use App\Http\Modules\Bases\RepositoryBase;
use App\Http\Modules\Marks\Models\Mark;

class MarkRepository extends RepositoryBase
{

    public function __construct(protected Mark $markModel)
    {
        parent::__construct($this->markModel);
    }

    /**
     * Get List Marks
     *
     * @return object
     */
    public function list(): object
    {
        return $this->markModel->select('id', 'name', 'created_at')
        ->with([
            "products" => fn ($query) => $query->select('id', 'name', 'price', 'mark_id', 'category_id')
            ->with(['category:id,name'])
        ])
            ->get();
    }

    /**
     * Get By Id Mark
     *
     * @param integer $id
     * @return Mark|null
     */
    public function getById(int $id): ?Mark
    {
        return $this->markModel->select('id', 'name', 'created_at')
            // ->with(["products:id,name,price,mark_id"])
            ->with([
                "products" => fn ($query) => $query->select('id', 'name', 'price', 'mark_id', 'category_id')
                    ->with(['category:id,name'])
            ])
            ->where('id', $id)->first();
    }
}
