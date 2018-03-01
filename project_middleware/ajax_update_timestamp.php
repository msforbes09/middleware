<?php
$current_timestamp = date("Y-m-d").' 00:00:00';
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=projectcodesystem;charset=utf8;', 'root', '' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
		"UPDATE projects
		SET finished_at = :finished_at
		WHERE code = :code"
	);
	$stmt->bindValue( ':finished_at', $current_timestamp, PDO::PARAM_STR );
	$stmt->bindValue( ':code', $_REQUEST["project_code"], PDO::PARAM_STR );
	$flag = $stmt->execute();
	if( ! $flag ) {
		$info = $stmt->errorInfo();
		exit( $info[2] );
	}
} catch( PDOException $e ) {
	echo $e->getMessage();
}
$pdo = null;

echo $current_timestamp;