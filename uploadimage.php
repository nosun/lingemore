<?php
if (empty($_POST['dir'])) {
    die("failed");
}
$error_list = array();
$dir = $_POST['dir'];
$first = true;
$main_image_dir = "uploadImage/" . $dir . "/";
$other_image_dir = "otherImage/" . $dir . "/";
if (is_dir($main_image_dir)) {
	rmdir($main_image_dir);
}
if (is_dir($other_image_dir)) {
	rmdir($other_image_dir);
}
foreach ($_FILES as $k => $v) {
    if (!empty($v['error'])) {
        $error_list[] = $name;
    } else {
        $name = $v["name"];
        $tmp_name = $v["tmp_name"];
        $image_info = getimagesize($tmp_name);
        if (!$image_info) {
            $error_list[] = $name;
        } else {
            if ($first) {
                $image_dir = "uploadImage/" . $dir . "/";
            } else {
                $image_dir = "otherImage/" . $dir . "/";
            }
            if (!is_dir($image_dir)) {
                mkdir($image_dir);
            }
            move_uploaded_file($tmp_name, $image_dir . $name);
        }
    }
    if ($first) {
        $first = false;
    }
}
if (!empty($error_list)) {
    echo implode(',', error_list);
} else {
    echo "success";
}
