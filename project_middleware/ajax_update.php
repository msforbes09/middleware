<?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=projectcodesystem;charset=utf8;', 'root', '' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
		"UPDATE projects
		SET
		name = :project,
		name_ja = :project_ja,
		remarks = :remarks
		WHERE
		code = :code"
	);
	$stmt->bindValue( ':code', $_REQUEST["code"], PDO::PARAM_STR );
	$stmt->bindValue( ':project', $_REQUEST["project"], PDO::PARAM_STR );
	$stmt->bindValue( ':project_ja', $_REQUEST["project_ja"], PDO::PARAM_STR );
	$stmt->bindValue( ':remarks', $_REQUEST["remarks"], PDO::PARAM_STR );
	$flag = $stmt->execute();
	if( ! $flag ) {
		$info = $stmt->errorInfo();
		exit( $info[2] );
	}
} catch( PDOException $e ) {
	echo $e->getMessage();
}
$pdo = null;