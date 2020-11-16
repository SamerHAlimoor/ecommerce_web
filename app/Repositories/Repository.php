<?php

namespace App\Repositories\Repository;

use App\Http\interfaces\RepositoryInterface\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }
    public function create(array $data)
    {
        return $this->model->create($data);

    }
    public function update(array $data, $id)
    {
        $select = $this->model->find($id);
        return $select->update($data);

    }
    public function show($id)
    {
        return $this->model->findOrFail($id);

    }
    public function delete($id)
    {return $this->model->destroy($id);
    }

    public function getModel()
    {
        # code...
        return $this->model;
    }
    public function setModel($model)
    {
        # code...
        $this->model = $model;
        return $this;
    }
    public function with($realation)
    {
        # code...
        return $this->model->with($realation);
    }
}