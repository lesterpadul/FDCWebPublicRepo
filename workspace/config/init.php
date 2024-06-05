<?php
session_start();

// // load the class
// require "config/classes/Car.php";

require "config/classes/DB.php";
$db = new DB();
function sanitize($input) {
    // Using mysqli_real_escape_string for basic sanitization
    global $conn;
    return mysqli_real_escape_string($conn, trim($input));
}

function get_ip_address() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
// $db->sql->query("insert 
// 		into users
// 			(
// 				status, 
// 				first_name, 
// 				last_name, 
// 				birthday
// 			)
// 			value (
// 				1,
// 				'Lester',
// 				'Padul',
// 				'1970-01-01'
// 		) ");

// echo "<pre>";
// $users = $db->sql->query("select * from users;");
// while ($row = $users->fetch_assoc()) {
//     print_r($row);
// }

// die();

// if ($users->num_rows > 0) {
// 	echo "naay data";
// } else {
// 	echo "walay data";
// }

// $result = $db->sql->query("delete from users where id = 25;");
// var_dump($result);

// $result2 = $db->sql->query("update users set first_name='Joe' where id = 26;");
// var_dump($result2);

// die();
