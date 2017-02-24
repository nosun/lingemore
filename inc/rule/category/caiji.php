<?
function make_real_url($oldurl,$index)
{
	return $oldurl . "/$index/" ; 
}

function preg_product_url($html)
{
	$pattern="/<h2>(.*)<\/h2>/i";
	preg_match($pattern,$html,$matches);
	return array("http://www.tidebuy.com/product/Glamorous-Organza-Red-Empire-One-Shoulder-Mini-Homecoming-Dresses-4216-236250.html","http://www.tidebuy.com/product/Hot-Mermaid-A-line-V-neck-Floor-length-Elastic-Woven-Satin-Red-P4415-Prom-Dress-236853.html","http://www.tidebuy.com/product/P1428-Prom-Dress-236831.html");
	return $matches[1];
}

/*
$str = file_get_contents("../c_template.html");
print_r(preg_product_url($str));
*/
?>