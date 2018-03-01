<?php
require_once 'functions.php';

try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=projectcodesystem;charset=utf8;', 'root', '' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"SELECT id,name FROM companies;"
	);
	$stmt->execute();
	$companies = '<option value=""></option>';
	while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
		$companies .= '<option value="'.$row["id"].'">'.$row["name"].'</option>';
	}
} catch( PDOException $e ) {
	echo $e->getMessage();
}
$pdo = null;
?>
<div class="row" style="margin-bottom: 30px;">
	<div class="col-sm-3 col-xs-3">
		<label for="status">status</label>
		<select class="form-control input-sm" id="status">
			<option value="all">All Projects</option>
			<option value="ongoing">On-going Projects</option>
			<option value="finished">Finished Projects</option>
			<option value="canceled">Canceled Projects</option>
		</select>
	</div>
	<div class="col-sm-3 col-xs-3">
		<label for="company">company</label>
		<select class="form-control input-sm" id="company">
			<?php echo $companies; ?>
		</select>
	</div>
	<div class="col-sm-2 col-xs-2">
		<label for="add">Add</label><br>
		<button class="btn btn-sm btn-primary" id="add" <?php echo admin($_SESSION["admin"]);?>>add <span class="glyphicon glyphicon-plus"></span></button>
	</div>
</div>