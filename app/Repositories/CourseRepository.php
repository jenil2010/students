<?php

namespace App\Repositories;

use App\Models\course;
use App\Repositories\Interfaces\CourseRepositoryInterface;

class CourseRepository implements CourseRepositoryInterface
{
    private $model;
    public function __construct(course $course)
    {
        $this->model = $course;
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
        $course = $this->find($id);
        $course->update($data);
        return $course;
    }
    public function delete($id){
        $course = $this->find($id);
        return $course->delete();
    }
    public function data(){
        $course = $this->model->query()->get();
        return $course;
    }
}
