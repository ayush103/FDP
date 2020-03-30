
<?php
$_SESSION['currentTab'] = "paper";

include 'includes/connection.php';

$table = "faculty"; 
$filename = "paper_publications_all"; 
$sql = "Select  faculty.Paper_title, faculty.Paper_type, faculty.Paper_N_I, faculty.conf_journal_name, faculty.paper_category, faculty.Date_from as Year, faculty.Date_to as Month, faculty.Location, faculty. paper_path, faculty.certificate_path, faculty.report_path, faculty.Paper_co_authors, faculty.volume, faculty.h_index, faculty.FDC_Y_N, scopusindex,scopus,
citations,presentation_status,presented_by,Link_publication,Paper_awards,FDC_approved_disapproved, Udate from faculty inner join facultydetails on faculty.Fac_ID = facultydetails.Fac_ID";
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
/*$connect = mysqli_connect("localhost", "root", "", "department");
$output = '';

 $query = "SELECT * FROM faculty";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row["Fac_ID"].'</td>  
                         <td>'.$row["Date_from"].'</td>  
           
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }*/

?>

