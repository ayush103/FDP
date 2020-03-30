<?php
$_SESSION['currentTab'] = "paper";

include 'includes/connection.php';

$table = "paper_review"; 
$filename = "technical_review"; 
$sql = "Select facultydetails.F_NAME, paper_review.Paper_title, paper_review.Paper_type, paper_review.Paper_N_I, paper_review.conf_journal_name, paper_review.paper_category, paper_review.Date_from, paper_review.Date_to, paper_review.organised_by, paper_review.details, paper_review.volume, paper_review.last_added, paper_review.noofdays from paper_review inner join facultydetails on paper_review.Fac_ID = facultydetails.Fac_ID";
$result = mysqli_query($conn,$sql) or die("Couldn't execute query:<br>" . mysqli_error(). "<br>" . mysqli_errno()); 
$file_ending = "xls";
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$filename.xls");
header("Pragma: no-cache"); 
header("Expires: 0");
$sep = "\t"; 
$names = mysqli_fetch_fields($result) ;
foreach($names as $name){
    print ($name->name . $sep);
    }
print("\n");
while($row = mysqli_fetch_row($result)) {
    $schema_insert = "";
    for($j=0; $j<mysqli_num_fields($result);$j++) {
        if(!isset($row[$j]))
            $schema_insert .= "NULL".$sep;
        elseif ($row[$j] != "")
            $schema_insert .= "$row[$j]".$sep;
        else
            $schema_insert .= "".$sep;
    }
    $schema_insert = str_replace($sep."$", "", $schema_insert);
    $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
    $schema_insert .= "\t";
    print(trim($schema_insert));
    print "\n";
}


?>

