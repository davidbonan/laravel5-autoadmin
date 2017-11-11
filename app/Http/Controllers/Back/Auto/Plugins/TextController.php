<?php

namespace App\Http\Controllers\Back\Auto\Plugins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TextController extends Controller
{
	public function index($fieldname, $value, $title, $params)
    {
    	return $value;
    }

    public function edit($fieldname, $value, $title, $params)
    {
        $colorpicker = getField($params,'colorpicker',NULL);
        $placeholder = getField($params,'placeholder',NULL);

        ob_start();
        ?>
        <div class="form-group">
            <label><?=$title;?></label>
            <input  type="text" 
                    name="<?=$fieldname;?>" 
                    class="form-control <?=$colorpicker ? 'color-picker':'';?>" 
                    placeholder="<?=$placeholder;?>" 
                    value="<?=$value;?>">
        </div>
        <?php
        $html = ob_get_clean();
        return $html;
    }

    public function update($fieldname, $value)
    {
        return $value;
    }
}