<?php 
//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
//header("Cache-Control: no-cache, must-revalidate"); 
//session_cache_limiter('nocache');
  session_start(); 
  require_once('../Connections/conn.php'); 
 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
function  getCompany($database_conn, $conn) {
    mysql_select_db($database_conn, $conn);
    $query_Recordset1 = "SELECT id, name  FROM  bookcompany";
    $result = mysql_query($query_Recordset1, $conn);
	$companyArray = array();

    while ($aRecord = mysql_fetch_assoc($result) ) {
	    $id = $aRecord['id'];
	    $name = $aRecord['name'];
		$itemArr = array($id, mb_substr($name, 0, 6,"UTF-8"));
		array_push($companyArray, $itemArr);
    }
	return $companyArray;
}
function  getSelectTag($database_conn, $conn, $name) {
    $tag = "<SELECT name='$name'> ";  // 
    $allCompany = getCompany($database_conn, $conn);
    for ( $n=0; $n< count($allCompany); $n++ ){
       $id = $allCompany[$n][0];
	   $name = $allCompany[$n][1];
	   $tag .= "<option value='$id'> $name </option>" ;

    }
	$tag .= "</SELECT>";
	return $tag;
}
echo getSelectTag($database_conn, $conn, "Comp");
 
?>
</body>
</html>
