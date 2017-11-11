<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Repositories\DemoRepository,
    Models\Demo
};

class DemoController extends Controller
{
	/**
	 * Implement Getter for use method getAll(), getOne() and new()
	 */	
    use Getter;

    public function __construct(DemoRepository $DemoRepository)
    {
        $this->DemoRepository = $DemoRepository;
    }
    
}
