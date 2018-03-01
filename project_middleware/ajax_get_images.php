<?php
//echo $_REQUEST["code"];

if( file_exists( './pictures/' . $_REQUEST["code"] ) ) {

	if(@array_merge(array_diff(scandir( './pictures/' . $_REQUEST["code"] ),array('.','..')))[0]) {
		foreach( array_merge(array_diff(scandir( './pictures/' . $_REQUEST["code"] ),array('.','..'))) as $image ) {
			echo '<a href="./pictures/' . $_REQUEST["code"].'/'.$image.'" target="blank"><img src="./pictures/' . $_REQUEST["code"].'/'.$image.'" style="height: 100px;" title="./pictures/'.$_REQUEST["code"].'/'.$image.'"></a>';
		}
	}
}