<?php

	function INSERT_LOG($table, $type, $identifier, $print = false){
		$array = [
			'a_ip' => $GLOBALS['REQUEST_IP'],
			'a_user' => $_SESSION['user_id'],
			'a_table' => $table,
			'a_type' => $type,
			'a_identifier' => $identifier,
		];
		if($print)
			echo '<script>console.log('.json_encode($array).');</script>';

		$dbh = dbconn()->prepare("INSERT INTO
			log_general (a_date, a_ip, a_user, a_table, a_type, a_identifier)
			VALUES (NOW(), :a_ip, :a_user, :a_table, :a_type, :a_identifier)");
		$dbh->bindParam(':a_ip', $array['a_ip'], PDO::PARAM_STR, 40);
		$dbh->bindParam(':a_user', $array['a_user'], PDO::PARAM_INT, 11);

		$dbh->bindParam(':a_table', $array['a_table'], PDO::PARAM_STR, 255);
		$dbh->bindParam(':a_type', $array['a_type'], PDO::PARAM_STR, 255);
		$dbh->bindParam(':a_identifier', $array['a_identifier'], PDO::PARAM_STR, 255);
		$dbh->execute();
	}
