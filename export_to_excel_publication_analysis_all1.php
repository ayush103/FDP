



<?php
ob_start();

session_start();
include 'includes/connection.php';
	
$flag_count = $_SESSION['flag_count'];		
		if($flag_count === 1)
		{
					$from_date =  $_SESSION['from_date'] ;
					$to_date = $_SESSION['to_date'] ;	
			$sql = "select F_NAME,Paper_title,Paper_type,Paper_N_I,paper_category,conf_journal_name,Date_from,Date_to,Location,Paper_co_authors,volume,scopusindex,scopus,h_index,
citations,FDC_Y_N,presentation_status,presented_by,Link_publication,Paper_awards,FDC_approved_disapproved,Udate	from faculty inner join facultydetails on faculty.Fac_ID = facultydetails.Fac_ID where faculty.Date_from >= '$from_date' and faculty.Date_from <= '$to_date' ";

		}
		else if($flag_count === 2)
		{
					$sname = $_SESSION['sname'] ;
			$sql = "SELECT F_NAME,Paper_title,Paper_type,Paper_N_I,paper_category,conf_journal_name,Date_from,Date_to,Location,Paper_co_authors,volume,scopusindex,scopus,h_index,
citations,FDC_Y_N,presentation_status,presented_by,Link_publication,Paper_awards,FDC_approved_disapproved,Udate from faculty inner join facultydetails on faculty.Fac_ID = facultydetails.Fac_ID and facultydetails.F_NAME like '%$sname%' ";
			
		}
		else if($flag_count === 3)
		{
					$from_date =  $_SESSION['from_date'] ;
					$to_date = $_SESSION['to_date'] ;
					$sname = $_SESSION['sname'] ;
					$sql = "SELECT F_NAME,Paper_title,Paper_type,Paper_N_I,paper_category,conf_journal_name,Date_from,Date_to,Location,Paper_co_authors,volume,scopusindex,scopus,h_index,
citations,FDC_Y_N,presentation_status,presented_by,Link_publication,Paper_awards,FDC_approved_disapproved,Udate from faculty inner join facultydetails on faculty.Fac_ID = facultydetails.Fac_ID and facultydetails.F_NAME like '%$sname%' and faculty.Date_from >= '$from_date' and faculty.Date_from <= '$to_date'";
				
			
		}
		
		if($result = mysqli_query($conn,$sql))
		{
$count = mysqli_num_rows($result);
 
$columnHeader = '';  
$columnHeader = "Faculty Name" . "\t" . "Paper Title" . "\t" . "Paper type" . "\t" . "Paper level" . "\t". "Paper category" . "\t". "conf_journal_name" . "\t". "Start Date" . "\t". "End Date" . "\t". "Location" .  "\t". "Paper_co_authors" .  "\t". "volume" . "\t". "Index applicable?(Scopus/SCI/both)?" . "\t". "Index (Scopus/SCI/both)" . "\t". "h_index" . "\t". "citations" . "\t". "FDC applicable ?" . "\t". "presentation_status" . "\t". "presented_by" . "\t". "Link of publication" . "\t". "Paper_awards" . "\t". "FDC_approved_disapproved" . "\t". "Updated on" . "\t";  
  
 // $columnHeader = "<b>".$columnHeader."</b>";
  
$setData = '';  
  
while ($rec = mysqli_fetch_row($result)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
  
  
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=paperpublicationanalysis.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  
  
echo ucwords($columnHeader). "\n" . $setData . "\n";  
		}
?>  
