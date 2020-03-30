<?php
ob_start();
session_start();
$_SESSION['currentTab']="technical_review";

include 'includes/connection.php';
$sql = $_SESSION['sql'];
$table = "paper_review"; 
$filename = "paper_review_analysis_hod"; 

$result = mysqli_query($conn,$sql) or die("Couldn't execute query:<br>" . mysqli_error(). "<br>" . mysqli_errno()); 
$file_ending = "xls";
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$filename.xls");
header("Pragma: no-cache"); 
header("Expires: 0");
$sep = "\t"; 
$names = mysqli_fetch_fields($result) ;
foreach($names as $name){
	if($name->name != 'paper_review_ID' && $name->name != 'Fac_ID' && $name->name != 'mail_letter_path' && $name->name != 'certificate_path' && $name->name != 'report_path' && $name->name != 'Mobile' && $name->name != 'Email' && $name->name != 'Password' && $name->name != 'token' && $name->name != 'Dept') 
    print ($name->name . $sep);
    }
print("\n");
while($row = mysqli_fetch_row($result)) {
    $schema_insert = "";
    for($j=2; $j<=18;$j++) {
	if($j != 11 && $j != 12 && $j != 13  && $j != 17)
		{
			if(!isset($row[$j]))
				$schema_insert .= "NULL".$sep;
			elseif ($row[$j] != "")
				$schema_insert .= "$row[$j]".$sep;
			else
				$schema_insert .= "".$sep;
		}
    }
    $schema_insert = str_replace($sep."$", "", $schema_insert);
    $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
    $schema_insert .= "\t";
    print(trim($schema_insert));
    print "\n";
}


?>

