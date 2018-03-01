<?php
$images = '';
$seqNo = '';
for ( $i = 0; $i <  count($_FILES["files"]["name"]); $i++ ) {
	//print_r(@$_FILES["files"]["name"][$i]);
	if( ! file_exists('./pictures/'.$_REQUEST["code"]) ) {
		mkdir('./pictures/'.$_REQUEST["code"] );
	}
	
	$array = @array_merge(array_diff(scandir( './pictures/' . $_REQUEST["code"] ),array('.','..')));
	rsort($array,SORT_NATURAL);
	//print_r($array);
	if( @$array[0] ) {
		$seqNo = @preg_replace('/\.jpg/','',explode('-',$array[0])[2]) + 1;
		//echo $seqNo;
	} else {
		$seqNo = 1;
	}
	
	if( move_uploaded_file(
		@$_FILES["files"]["tmp_name"][$i], 
		'./pictures/'.$_REQUEST["code"].'/'.$_REQUEST["code"].'-'.$seqNo.'.jpg'
	) ) {
		$images .= '<a href="./pictures/'.$_REQUEST["code"].'/'.$_REQUEST["code"].'-'.$seqNo.'.jpg" target="blank">
		<img src="./pictures/'.$_REQUEST["code"].'/'.$_REQUEST["code"].'-'.$seqNo.'.jpg" title="./pictures/'.$_REQUEST["code"].'/'.$_REQUEST["code"].'-'.$seqNo.'.jpg" style="height: 100px;"></a>';
	}
}
echo $images;