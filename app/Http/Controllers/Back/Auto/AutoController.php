<?php

namespace App\Http\Controllers\Back\Auto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AutoController extends Controller
{	

	public function __construct(Request $request){
		$this->title = config('auto-admin.'.$request->class.'.config.title');
		$this->classname = config('auto-admin.'.$request->class.'.config.classname');
		$this->action = $request->segments()[3];

		// For action = index
		if($this->action == 'index') {
			$this->columns = config('auto-admin.'.$request->class.'.index.columns');			
		}

		if($this->action == 'edit' || $this->action == 'update') {
			$this->title = config('auto-admin.'.$request->class.'.edit.title');
			$this->layout = config('auto-admin.'.$request->class.'.edit.layout');
			$this->columns = config('auto-admin.'.$request->class.'.edit.columns');
		}
		
		$this->controller = $this->loadController('App\Http\Controllers\Back\\'.$request->class.'Controller');
    	if(!$this->controller)
    		return "Le panneau d'adinistration d'existe pas.";
	}

    public function index()
    {
    	$title = $this->title;
    	$class = strtolower($this->classname);
    	$columns = $this->columns;
    	
    	// Parse all items with plugin    	
    	$items = $this->controller->getAll($this->classname);
    	$items = $this->parseItemsWithPlugin($items);

    	return view('back.auto.index', compact('class','title','columns','items'));
    }

    public function create(Request $request){
    	$item = $this->controller->new($this->classname);
    	return redirect()->route('auto.edit', ['class' => $request->class, 'id' => $item->id]);
    }

    public function edit(Request $request)
    {
        $title = $this->title;
        $class = strtolower($this->classname);
        $layout = $this->layout;
        $id = $request->id;

        // Parse all items with plugin
        $item = $this->controller->getOne($this->classname, $request->id);
        $item = $this->parseItemWithPlugin($item, 'edit');
        return view('back.auto.edit', compact('class','title','id','item','layout'));
    }

    public function update(Request $request)
    {
    	$item = $this->controller->getOne($this->classname, $request->id);
    	$inputs = $request->toArray();
    	foreach ($inputs as $key => $value) {
    		if($key == '_token') 
    			continue;
    		$class_plugin = isset($this->columns[$key]['plugin']) 
							? $this->columns[$key]['plugin'].'Controller' 
							: 'TextController';
    		$plugin = $this->loadController('App\Http\Controllers\Back\Auto\Plugins\\'.$class_plugin);

    		$v = $plugin->update($key, $value, getField($this->columns[$key],'params',false));
			if(is_array($v))
			{
				foreach($v as $kk=>$vv)
					$item->$kk = $vv;
			}
			elseif($v!==NULL)
				$item->$key = $v;
    	}
    	$item->save();
        return redirect()->route('auto.edit', ['class' => $request->class, 'id' => $request->id]);
    }

    public function destroy(Request $request)
    {
        $item = $this->controller->getOne($this->classname, $request->id);
        if($item)
        	$item->delete();
        return redirect()->route('auto.index', ['class' => $request->class]);
    }

    public function parseItemsWithPlugin($items){
    	$parsed_items = array();
    	foreach ($items as $item_key => $item)
	    	$parsed_items[$item_key] = $this->parseItemWithPlugin($item, $this->action);
    	return $parsed_items;
    }

    public function parseItemWithPlugin($item){
    	$parsed_item = array();
		foreach ($this->columns as $column_key => $value) {
			$class_plugin = isset($this->columns[$column_key]['plugin']) 
							? $this->columns[$column_key]['plugin'].'Controller' 
							: 'TextController';
    		$plugin = $this->loadController('App\Http\Controllers\Back\Auto\Plugins\\'.$class_plugin);
    		$html = $plugin->{$this->action}($column_key, $item->$column_key, getField($value,'title',false), getField($value,'params',false));
    		if($this->action == "index")
    			$parsed_item[$column_key] = $html;
    		elseif($this->action == "edit")
    			$parsed_item[$column_key] = array(
    				'html' => $html,
    				'section' => getField($value,'section',false),
    			);
		}
    	return $parsed_item;
    }
}
