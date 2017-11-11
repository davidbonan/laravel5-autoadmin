<?php

namespace App\Repositories;
use App\Models\ {
    Demo
};

class DemoRepository{
	/**
     * The Model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Create a new DemoRepository instance.
     *
     * @param  \App\Models\Demo $demo
     */
    public function __construct(Demo $demo)
    {
        $this->model = $demo;
    }

    public function getAll(){
    	return $this->model
    				->latest()
    				->get();
    }
}