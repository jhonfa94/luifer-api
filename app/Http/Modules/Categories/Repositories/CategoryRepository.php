<?php

namespace App\Http\Modules\Categories\Repositories;

use App\Http\Modules\Bases\RepositoryBase;
use App\Http\Modules\Categories\Models\Category;

class CategoryRepository extends RepositoryBase
{
    protected $categoryModel;

    public function __construct(Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
        parent::__construct($this->categoryModel);
    }

    /**
     * Get List Categories.
     *
     * @return object
     */
    public function list(): object
    {
        return $this->categoryModel->select('id', 'name', 'created_at')->get();
    }

    /**
     * Get By Id Category
     *
     * @param integer $id
     * @return Category|null
     */
    public function getById(int $id): ?Category
    {
        return $this->categoryModel->select('id', 'name', 'created_at')
            ->with([
                'products' => fn ($query) =>  $query->select('id', 'name', 'category_id', 'mark_id')->with(['mark:id,name'])
            ])->where('id', $id)->first();
    }
}
