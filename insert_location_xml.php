<?php


$username=$_POST['name'];
$useremail=$_POST['email'];
$phone=$_POST['phone'];
$pickloc=$_POST['pickloc'];
$droploc=$_POST['droploc'];
$date=$_POST['date'];


//insert into xml document
appendPatient("username",$username);
appendPatient("useremail",$useremail);
appendPatient("phone",$phone);
appendPatient("pickloc",$pickloc);
appendPatient("droploc",$droploc);
appendPatient("date",$date);




function appendPatient($tag,$data){
	$xdoc = new DomDocument;
	$xdoc->Load('location.xml');
	$location = $xdoc->getElementsByTagName('location')->item(0);
	$newElement = $xdoc ->createElement($tag);
	$txtNode = $xdoc ->createTextNode ($data);
	$newElement -> appendChild($txtNode);
	$location -> appendChild($newElement);
	$test = $xdoc->save("location.xml");
}


	function get_data() { 
		
		$file_name='location'. '.json'; 

		if(file_exists("$file_name")) { 
			$current_data=file_get_contents("$file_name"); 
			$array_data=json_decode($current_data, true); 
							
			$extra=array( 
				'username' => $_POST['name'], 
				'useremail' => $_POST['email'], 
				'phone' => $_POST['phone'], 
				'pickloc' => $_POST['pickloc'], 
				'droploc' => $_POST['droploc'], 
				'date' => $_POST['date'],  
			); 
			$array_data[]=$extra; 
			
			return json_encode($array_data); 
		} 
		else { 
			$datae=array(); 

			$datae[]=array( 
				'username' => $_POST['name'], 
				'useremail' => $_POST['email'], 
				'phone' => $_POST['phone'], 
				'pickloc' => $_POST['pickloc'], 
				'droploc' => $_POST['droploc'], 
				'date' => $_POST['date'], 
			); 
			
			return json_encode($datae); 
		} 
	} 

$file_name='location'. '.json'; 
	
	if(file_put_contents("$file_name", get_data())) { 
		header("Location: index.php");
		}

?>