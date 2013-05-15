<?php
function format_currency($val) {
    if ($val < 1) return  '$0.'. intval(round($val * 100));
    if (fmod($val, 1.0) == 0) return '$' . intval($val);
    return '$' . intval($val) . '.' . intval(round((fmod($val,1))*100));
}

function percentage($val1, $val2) 
{
	$res = round( ($val1 / $val2) * 100);
	
	return $res;
}

?>