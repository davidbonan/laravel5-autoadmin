<?php
namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;

trait Getter
{

	public function getAll($classname)
	{
		$app = app();
		$model = $app->make('App\Models\\'.$classname);
		$repository_name = $classname.'Repository';
		if($this->$repository_name && method_exists($this->$repository_name, 'getAll')){
			return $this->$repository_name->getAll();
		}
		else{
			$model = $app->make('App\Models\\'.$classname);
			return $model::get();
		}
	}

	public function getOne($classname, $id)
	{
		$app = app();		
		$repository_name = $classname.'Repository';
		if($this->$repository_name && method_exists($this->$repository_name, 'getOne')){
			return $this->$repository_name->getOne($id);
		}
		else{
			$model = $app->make('App\Models\\'.$classname);
			return $model::find($id);
		}
	}

	public function new($classname){
		$app = app();
		$model = $app->make('App\Models\\'.$classname);
		$repository_name = $classname.'Repository';
		if($this->$repository_name && method_exists($this->$repository_name, 'new')){
			return $this->$repository_name->new();
		}
		else{
			$model = $app->make('App\Models\\'.$classname);
			$item = new $model;
			$item->save();
			return $item;
		}
	}
}