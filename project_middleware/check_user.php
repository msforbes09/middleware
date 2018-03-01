<?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=projectcodesystem;charset=utf8;', 'root', '' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
		"SELECT * FROM users
		WHERE
		employee_code = :employee_code
		AND
		password = :password"
	);
	$stmt->bindValue( ':employee_code', $_REQUEST["employee_code"], PDO::PARAM_STR );
	$stmt->bindValue( ':password', md5($_REQUEST["password"]), PDO::PARAM_STR );
	$stmt->execute();
	$cnt = $stmt->rowCount();
	while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
		$admin = $row["admin"];
	}
} catch( PDOException $e) {
	echo $e->getMessage();
}
$pdo = null;