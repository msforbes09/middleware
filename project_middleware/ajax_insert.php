<?php
function project_code($last_project_code) {
	$segs = explode('-',$last_project_code);
	$company_code = $segs[0];
	$project_code = $segs[1];
	$project_code++;
	return $company_code.'-'.$project_code;
}

function last_project_code($company_id) {
	try {
		$pdo = new PDO( 'mysql:host=localhost;dbname=projectcodesystem;charset=utf8;', 'root', '' );
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$stmt = $pdo->prepare(
			"SELECT * FROM projects WHERE company_id = :company_id ORDER BY code DESC"
		);
		$stmt->bindValue(':company_id',$company_id,PDO::PARAM_INT );
		$stmt->execute();
		$array = array();
		while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			$array[] = $row["code"];
		}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
	$pdo = null;
	return $array[0];
}

try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=projectcodesystem;charset=utf8;', 'root', '' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
		"INSERT INTO projects
		SET
		company_id = :company_id,
		code = :code,
		name = :name,
		name_ja = :name_ja
		"
	);
	$stmt->bindValue( ':company_id', $_REQUEST["company_id"], PDO::PARAM_INT );
	$stmt->bindValue( ':code', project_code(last_project_code($_REQUEST["company_id"])), PDO::PARAM_STR );
	$stmt->bindValue( ':name', $_REQUEST["name"], PDO::PARAM_STR );
	$stmt->bindValue( ':name_ja', $_REQUEST["name_ja"], PDO::PARAM_STR );
	$flag = $stmt->execute();
	if( ! $flag ) {
		$info = $stmt->errorInfo();
		exit( $info[2] );
	}
} catch( PDOException $e ) {
	echo $e->getMessage();
}
$pdo = null;

echo project_code(last_project_code($_REQUEST["company_id"]));