<?php


/**
 * Cette fonction permet de récupérer une entrée dans un tableau tout en vérifiant automatiquement l'existance de l'information ciblé.
 *
 * Il est possible de préciser la valeur de retour si l'entrée n'existe pas (ou si elle est vide si $notempty est fixé à TRUE)
 *
 * $data = array('param'=>foo','void'=>'','complex'=>array('child'=>'foo'));
 * getField($data,'missing'); // NULL
 * getField($data,'missing',FALSE); // FALSE
 * getField($data,'param'); // 'foo'
 * getField($data,void'); // ''
 * getField($data,'void','empty field',true); // 'empty field'
 * getField($data,array('complex','child')); // 'foo
 */
function getField($array,$field,$default=NULL,$notempty=false){
	if(is_array($field)){
		$v = $array;
		foreach($field as $f)
			$v = getField($v,$f,$default,$notempty);
		return $v;
	}
	if(is_array($array) && isset($array[$field]))
	{
		if($notempty && ($array[$field]===NULL || $array[$field]===''))
		{
			return $default;
		}
		return $array[$field];
	}
	if(is_object($array) && isset($array->$field))
	{
		if($notempty && ($array->$field===NULL || $array->$field===''))
		{
			return $default;
		}
		return $array->$field;
	}
	return $default;
}


/**
 * traitement des chaines pour ne pas avoir de problème avec les injection d'attribut HTML
 * &lt;input type=&quot;&lt;?=TextField('Mon texte');?&gt;&quot;&gt;
 */
function Textfield($string,$keepBR=true)
{
	$string = str_replace('"','&quot;',$string);
	if(!$keepBR)
		$string = preg_replace("/ +/",' ',preg_replace("/\r|\n/",' ',$string));
	return $string;
}