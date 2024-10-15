<?php

namespace App\Repositories;

use App\Models\wardens;
use App\Repositories\Interfaces\WardenRepositoryInterface;

class WardenRepository implements WardenRepositoryInterface
{
    private $model;
    public function __construct(wardens $wardens)
    {
        $this->model = $wardens;
    }

    public function all(){
        return $this->model->all();
    }
    public function find($id){
        return $this->model->find($id);
    }
    public function create(array $data){
        return $this->model->create($data);
    }
    public function update($id, array $data){
        $wardens = $this->find($id);
        $wardens->update($data);
        return $wardens;
    }
    public function delete($id){
        $wardens = $this->find($id);
        $wardens->delete();
    }
    // public function data(){
    //     $wardens = $this->model->query()->get();
    //     return $wardens;
    // }
}
