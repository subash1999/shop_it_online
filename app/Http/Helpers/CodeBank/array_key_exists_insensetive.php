<?php 

    /*  Case insensetive array_key_exists() wrapper
    *
    *   @param mixed $needle value to seek
    *   @param array $haystack array to seek
    *
    *   @return bool
    */
    public function array_key_exists_insensetive($needle,$haystack)
    {
    	return array_key_exists(strtolower($needle),array_map('strtolower',$haystack));
    }