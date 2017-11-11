<?php

namespace App\Http\Controllers\Back\Auto\Plugins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelectController extends Controller
{
	public function index($fieldname, $value)
    {
    	return "<span class='label label-primary'>".$value."</span>";
    }

    public function edit($fieldname, $value, $title, $params)
    {
        $options = getField($params,'options',array());
        $multiple = getField($params,'multiple',false);
        $selected = $value;

        // si récupère du JSON on le décode
        if(is_string($selected))
        {
            $temp = json_decode($selected);
            if($temp!==null)
                $selected = $temp;
        }

        if($selected!==null)
            $selected = is_array($selected) ? $selected:array($selected);

        ob_start();
        ?>
        <div class="form-group">
            <label><?=$title;?></label>
            <select class="form-control select2" 
                    style="width: 100%;" 
                    name="<?=$fieldname;?><?=$multiple ? '[]':'';?>" 
                    <?=($multiple ? 'multiple="multiple"' : '');?>>
                <?php
                foreach ($options as $key => $value) {
                    ?>
                    <option value="<?=$key;?>" <?=(in_array($key, $selected) ? 'selected' : '');?>><?=$value;?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <?php
        $html = ob_get_clean();
        return $html;
    }

    public function update($fieldname, $value, $params)
    {
        //dd($value);
        $multiple = getField($params,'multiple',false);
        if($multiple)
            $v = is_string($value) ? $value : json_encode($value);
        else
            $v = $value;
        return $v;
    }
}