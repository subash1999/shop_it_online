<?php 
/*Case insensetive in_array() wrapper
*
*	@param mixed $needle value to seek
*	@param array $haystack array to seek
*
* 	@return bool
*/
function in_array_insensetive($nedle,$haystack)
{
	return in_array(strtolower($needle),array_map('strtolower',$haystack));
}