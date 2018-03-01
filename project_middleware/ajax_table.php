<?php
session_start();
require_once 'functions.php';

function update_timestamp( $status, $finished_at ) {
	if( $status === 'ongoing' ) {
		return '<button class="btn btn-xs btn-warning update" '.admin($_SESSION["admin"]).'>Update</button>';
	} else {
		return $finished_at;
	}
}

if( $_REQUEST["status"] === 'all' ) {
	$status = " AND projects.cancel = 0 ";
} elseif( $_REQUEST["status"] === 'ongoing' ) {
	$status = " AND projects.finished_at = '0000-00-00 00:00:00' AND projects.cancel = 0 ";
} elseif( $_REQUEST["status"] === 'finished' ) {
	$status = " AND projects.finished_at <> '0000-00-00 00:00:00' AND projects.cancel = 0 ";
} elseif( $_REQUEST["status"] === 'canceled' ) {
	$status = " AND projects.cancel = 1 ";
}

$company = '';
switch( $_REQUEST["company"] ) {
	case 1:
		$company = " AND companies.id = 1";
		break;
	case 2:
		$company = " AND companies.id = 2";
		break;
	case 3:
		$company = " AND companies.id = 3";
		break;
	case 4:
		$company = " AND companies.id = 4";
		break;
	case 5:
		$company = " AND companies.id = 5";
		break;
	case 6:
		$company = " AND companies.id = 6";
		break;
	case 7:
		$company = " AND companies.id = 7";
		break;
	default:
		$company = "";
}

try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=projectcodesystem;charset=utf8;', 'root', '' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"SELECT
		projects.code as code,
		projects.name as project_name,
		projects.name_ja as project_name_ja,
		projects.created_at as project_created_at,
		projects.finished_at as project_finished_at,
		projects.remarks as remarks,
		companies.name as company_name
		FROM
		projects,
		companies
		WHERE
		projects.company_id = companies.id
		$status
		$company
		"
	);
	$stmt->execute();
	$cnt = $stmt->rowCount();
	$tbody = '';
	while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
		$tbody .= '<tr>';
		$tbody .= '<td>'.$row["company_name"].'</td>';
		$tbody .= '<td class="project_code">'.$row["code"].'</td>';
		$tbody .= '<td class="project_name">'.$row["project_name"].'</td>';
		$tbody .= '<td class="project_name_ja">'.$row["project_name_ja"].'</td>';
		$tbody .= '<td>'.$row["project_created_at"].'</td>';
		$tbody .= '<td>'.update_timestamp($_REQUEST["status"],$row["project_finished_at"]).'</td>';
		$tbody .= '<td class="remarks">'.$row["remarks"].'</td>';
		$tbody .= '<td><button class="btn btn-xs btn-warning edit " '.admin($_SESSION["admin"]).'>Edit <span class="glyphicon glyphicon-edit"></span></button></td>';
		$tbody .= '<td><button class="btn btn-xs btn-danger cancel " '.admin($_SESSION["admin"]).'>Cancel<span class="glyphicon glyphicon-remove"></span></button></td>';
		$tbody .= '</tr>';
	}
} catch( PDOException $e ) {
	echo $e->getMessage();
}
?>
<p><span style="color: red; font-weight: bold;"><?php echo $cnt; ?></span> record(s) found.</p>

<div class="table-responsive">
	<table class="table">
		<thead>
			<tr class="bg-primary">
				<th>Company</th>
				<th>Code</th>
				<th>Project</th>
				<th>Project_ja</th>
				<th>Code Assigned</th>
				<th>Date Finished</th>
				<th>Remarks</th>
				<th>Edit</th>
				<th>Cancel</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $tbody; ?>
		</tbody>
	</table>
</div>
	