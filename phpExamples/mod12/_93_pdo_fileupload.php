<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>fetchAll()</title>

</head>
<body>
<hr/>
<hr/>
<?php

	//  The connection remains active for the lifetime of that PDO object. To close the connection, you need to destroy the object by ensuring that all remaining references to it are deleted--you do this by assigning NULL to the variable that holds the object. If you don't do this explicitly, PHP will automatically close the connection when your script ends.
	$pdo = new PDO('mysql:host=localhost; port=3306; dbname=proj; charset=utf8', 'root', 'root',
			array(PDO::ATTR_EMULATE_PREPARES=>false,
					PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_PERSISTENT => true
			)
	);
if(isset($_FILES['files'])){
	$query = "INSERT into ImagesTable(`FILE_NAME`,`FILE_SIZE`,`FILE_TYPE`)
             VALUES(:FILE_NAME,:FILE_SIZE,:FILE_TYPE)";
	$stmt  = $pdo->prepare($query);
	$errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $error ){
		if ($error != UPLOAD_ERR_OK) {
			$errors[] = $_FILES['files']['name'][$key] . ' was not uploaded.';
			continue;
		}
		$file_name = $key.$_FILES['files']['name'][$key];
		$file_size = $_FILES['files']['size'][$key];
		$file_tmp  = $_FILES['files']['tmp_name'][$key];
		$file_type = $_FILES['files']['type'][$key];
		if($file_size > 2097152){
			$errors[] = 'File size must be less than 2 MB';
			continue;
		}
		try{
			$stmt->bindParam( ':FILE_NAME', $file_name , PDO::PARAM_STR );
			$stmt->bindParam( ':FILE_SIZE', $file_size, PDO::PARAM_STR );
			$stmt->bindParam( ':FILE_TYPE', $file_type, PDO::PARAM_STR );
			$stmt->execute();

			$desired_dir= $_SERVER['DOCUMENT_ROOT'] . "/" . "image_uploads";

			if(is_dir($desired_dir)==false){
				mkdir($desired_dir, 0700);// Create directory if it does not exist
				echo "create Dir";
			} else {
				echo "Dir Exist ";
			}
			if(is_file($desired_dir.'/'.$file_name)==false){
				move_uploaded_file($file_tmp,$desired_dir.'/'.$file_name);
				echo "move_uploaded_file 1 ";
			}else{    //rename the file if another one exist
				$new_file=$desired_dir.'/'.$file_name.time();
				move_uploaded_file($file_tmp,$new_file) ;
				echo "move_uploaded_file 2 ";
			}
		}catch(PDOException $ex){
			$errors[] = $file_name . 'not saved in db.';
			echo $ex->getMessage();
		}
	}
	if(empty($error)){
		echo "上傳成功";
	}
}
?>

</body>
</html>
