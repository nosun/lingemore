<?php

function insertWholesaleUser($post) {
	$conn = mysql_connect("localhost","lingeriemoreuser","lingeriemorepassword");
        if (!$conn) {
                return false;
        }
	mysql_select_db("lingeriemore", $conn);
	$sql = sprintf('insert into wholesale_user(name, email, country, phone, website,comment) values ("%s", "%s", "%s", "%s", "%s", "%s")', mysql_escape_string($post['name']),
	mysql_escape_string($post['email']),
	mysql_escape_string($post['country']),
	mysql_escape_string($post['phone']),
	mysql_escape_string($post['website']),
	mysql_escape_string($post['comment']));
	$ret = mysql_query($sql, $conn);
        mysql_close($conn);	
	return $ret;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$ret = array();
  	$post = $_POST;
  	if (!isset($post['name']) || trim($post['name']) == "") {
  		$ret['success'] = false;
  		$ret['message'] = 'Please input your name.';
  		echo json_encode($ret);
  		return;
  	}
  	if (!isset($post['email']) || trim($post['email']) == "") {
  		$ret['success'] = false;
  		$ret['message'] = 'Please input your email.';
  		echo json_encode($ret);
  		return;
  	} else {
  		if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
  			$ret['success'] = false;
  			$ret['message'] = 'Invalid email.';
  			echo json_encode($ret);
  			return;
  		}
  	}
  	if (!isset($post['country']) || trim($post['country']) == "") {
  		$ret['success'] = false;
 		$ret['message'] = 'Please input your conutry name.';
		echo json_encode($ret);
  		return;
  	}
  	if (!isset($post['phone']) || trim($post['phone']) == "") {
  		$ret['success'] = false;
  		$ret['message'] = 'Please input your phone number.';
  		echo json_encode($ret);
  		return;
  	}
	if (!isset($post['website'])) {
		$post['website'] = '';
	}
	if (!isset($post['comment'])) {
		$post['comment'] = '';
	}
  	if(!insertWholesaleUser($post)) {
  		$ret['success'] = false;
  		$ret['message'] = 'Add wholesale info failed.';
  		echo json_encode($ret);
  		return;
  	} else {
  		$ret['success'] = true;
  		echo json_encode($ret);
  	}
}
