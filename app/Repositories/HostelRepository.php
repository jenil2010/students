<?php

namespace App\Repositories;

use App\Models\hostels;
use App\Repositories\Interfaces\HostelRepositoryInterface;

class HostelRepository implements HostelRepositoryInterface
{
    private $model;
    private $WardenRepository;
    public function __construct(hostels $hostel,WardenRepository $WardenRepository)
    {
        $this->model = $hostel;
        $this->WardenRepository = $WardenRepository;
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
        $hostel = $this->find($id);
        $hostel->update($data);
        return $hostel;
    }
    public function delete($id){
        $hostel = $this->find($id);
        $hostel->delete();
    }
    public function data(){
        $warden = $this->WardenRepository->all();
        $hostel = $this->model->with('warden')->get();
        return $hostel;
    }
}
