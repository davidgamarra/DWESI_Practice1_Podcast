<?php

class Request {
    static function get($item, $filtrar = true, $index = null){
        if(isset($_GET[$item])){
            return self::read($_GET[$item], $filtrar, $index);
        }
        return null;
    }
    
    static function post($item, $filtrar = true, $index = null){
        if(isset($_POST[$item])){
            return self::read($_POST[$item], $filtrar, $index);
        }
        return null;
    }
    
    static function req($item, $filtrar = true, $index = null){
        $value = self::post($item, $filtrar, $index);
        if($value !== null){
            return $value;
        } 
        return self::get($item, $filtrar, $index);
    }
    
    static function myreadArray($item, $index = null){
        if($index === null){
            return self::req($item);
        } else {
            return self::req($item)[$index];
        }
    }
    
    static function readArray($item, $index = null){
        if(isset($_GET[$item])){
            if($index === null){
                $array = array();
                foreach($_GET[$item] as $value){
                    $array[] = self::clean($value);
                }
                return $array;
            } else if(isset($_GET[$item][$index])) {
                return self::clean($_GET[$item][$index]);
            }
        } else {
            return self::clean($_GET[$item]);
        }
    }
    
    private static function read($item, $filtrar = true, $index = null){
        if(is_array($item)){
            if($index === null){
                $array = array();
                foreach($item as $value){
                    $array[] = self::clean($value, $filtrar);
                }
                return $array;
            } else if(isset($item[$index])) {
                return self::clean($item[$index], $filtrar);
            }
        } else {
            return self::clean($item, $filtrar);
        }
    }
    
    private static function myClean($value){
        $value = str_replace(' ', '-', $value); // Replaces all spaces with hyphens.
   		return preg_replace('/[^A-Za-z0-9\-]/', '', $value); // Removes special chars.
    }
	
	private static function clean($value, $filtrar){
		if($filtrar === true){
			return htmlspecialchars($value);
		}
		return trim($value);
	}
	
	
}