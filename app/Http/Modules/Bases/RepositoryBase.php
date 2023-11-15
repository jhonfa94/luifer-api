<?php

namespace App\Http\Modules\Bases;

use Illuminate\Database\Eloquent\Model;

class RepositoryBase
{
    function __construct(
        protected Model $model
    ) {
    }


    /**
     * Save and return saved model.
     *
     * @param Model $model
     * @return Model|null
     */
    public function save(Model $model): ?Model
    {
        $model->save();
        return $model;
    }

    /**
     * Find one row.
     *
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

}


?>
