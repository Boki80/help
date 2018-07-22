<?php

function test_input($data) {
	$data = trim($data);
 	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
}

function escape($data) {
	include 'db_connect.php';
	$data = trim($data);
 	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	$data = mysqli_real_escape_string($conn, $data);
  	return $data;
}

function profesor($id) {
	include 'db_connect.php';
	$sql = "SELECT * FROM profesori ";
	$sql = "WHERE id = $id";
	
	$result = mysqli_query($conn, $sql) or trigger_error(mysql_error());

	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		return $prof = array('ime' => $row['ime'], 'prezime' => $row['prezime'] );
	} else {
		return 0;
	}
}

function profesor_ime($id) {
	include 'db_connect.php';
	$sql = "SELECT ime FROM profesori ";
	$sql .= "WHERE id = $id";

	$result = mysqli_query($conn, $sql) or trigger_error(mysql_error());

	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		return $row['ime'];
	} else {
		return 0;
	}

}

function profesor_prezime($id) {
	include 'db_connect.php';
	$sql = "SELECT prezime FROM profesori ";
	$sql .= "WHERE id = $id";

	$result = mysqli_query($conn, $sql) or trigger_error(mysqli_error());

	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		return $row['prezime'];
	} else {
		return 0;
	}

}

function check_termin($termin, $dan, $profesor, $id) {
	include 'db_connect.php';
	$sql = "SELECT id, termin, dan, profesor_id FROM raspored ";
	$sql .= "WHERE id != $id AND termin = $termin AND dan = '{$dan}' AND profesor_id = $profesor";

	$result = mysqli_query($conn, $sql) or trigger_error(mysqli_error());

	if(mysqli_num_rows($result) >= 1) {
		$row = mysqli_fetch_assoc($result);
		return 1;
	} else {
		return 0;
	}
}

function check_termin_grupa($termin, $dan, $grupa, $id) {
	include 'db_connect.php';
	$sql = "SELECT id, termin, dan, grupa$grupa FROM raspored ";
	$sql .= "WHERE id != $id AND termin = $termin AND dan = '{$dan}' AND grupa$grupa = 1";

	$result = mysqli_query($conn, $sql) or trigger_error(mysqli_error());

	if(mysqli_num_rows($result) >= 1) {
		$row = mysqli_fetch_assoc($result);
		return 1;
	} else {
		return 0;
	}
}

function check_termin_sala($termin, $dan, $sala, $id) {
	include 'db_connect.php';
	$sql = "SELECT id, termin, dan, sala FROM raspored ";
	$sql .= "WHERE id != $id AND termin = $termin AND dan = '{$dan}' AND sala = $sala";

	$result = mysqli_query($conn, $sql) or trigger_error(mysqli_error());

	if(mysqli_num_rows($result) >= 1) {
		$row = mysqli_fetch_assoc($result);
		return 1;
	} else {
		return 0;
	}
}

function access($level) {
	if(isset($_SESSION['login_user'])) {
		include 'db_connect.php';

		$user = $_SESSION['login_user'];

		$sql = "SELECT permisije FROM users ";
		$sql .= "WHERE email = '{$user}' AND aktivan = 1";

		$result = mysqli_query($conn, $sql) or trigger_error(mysqli_error());

		if(mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_assoc($result);
			if($level <= $row['permisije']) {
				return 1;
			} else {
				return 0;
			}
			return 1;
		} else {
			return 0;
		}
	} else {
		return 0;
	}
}

function bb($text) {
	$text = strip_tags($text);
	// BBcode array
	$find = array(
		'~\[b\](.*?)\[/b\]~s',
		'~\[i\](.*?)\[/i\]~s',
		'~\[u\](.*?)\[/u\]~s',
		'~\[quote\]([^"><]*?)\[/quote\]~s',
		'~\[size=([^"><]*?)\](.*?)\[/size\]~s',
		'~\[color=([^"><]*?)\](.*?)\[/color\]~s',
		'~\[url\]((?:ftp|https?)://[^"><]*?)\[/url\]~s',
		'~\[img\](https?://[^"><]*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s'
	);
	// HTML tags to replace BBcode
	$replace = array(
		'<b>$1</b>',
		'<i>$1</i>',
		'<span style="text-decoration:underline;">$1</span>',
		'<pre>$1</'.'pre>',
		'<span style="font-size:$1px;">$2</span>',
		'<span style="color:$1;">$2</span>',
		'<a href="$1">$1</a>',
		'<img src="$1" alt="" class="w-100 carousel-img py-5" />'
	);
	// Replacing the BBcodes with corresponding HTML tags
	return preg_replace($find, $replace, $text);
}

?>