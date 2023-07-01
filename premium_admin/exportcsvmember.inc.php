<?php
 function mysqli_field_name($result, $field_offset){
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->name : null;
}
function exportMysqlToCsv($table,$filename = 'member-report.csv')
{
	//$myConnection= mysqli_connect("localhost","root","") or die ("could not connect to mysql"); 
    //$connection=mysqli_select_db($myConnection, "premium-matrimony") or die ("no database");
	include('../dbConf.php');
    $csv_terminated = "\n";
    $csv_separator = ",";
    $csv_enclosed = '"';
    $csv_escaped = "\\";
    
 
    // Gets the data from the database
    $result = mysqli_query($db,"SELECT * FROM $table");
    $fields_cnt = mysqli_num_fields($result);
 
 
    $schema_insert = '';
 	
    for ($i = 0; $i < $fields_cnt; $i++){
        $l = $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed,
            stripslashes(mysqli_field_name($result, $i))) . $csv_enclosed;
        $schema_insert .= $l;
        $schema_insert .= $csv_separator;
    } // end for
 
    $out = trim(substr($schema_insert, 0, -1));
    $out .= $csv_terminated;
 
    // Format the data
    while ($row = mysqli_fetch_array($result)){
        $schema_insert = '';
        for ($j = 0; $j < $fields_cnt; $j++){
            if ($row[$j] == '0' || $row[$j] != ''){
                if ($csv_enclosed == ''){
                    $schema_insert .= $row[$j];
                } else{
                    $schema_insert .= $csv_enclosed . 
					str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $row[$j]) . $csv_enclosed;
                }
            } else{
                $schema_insert .= '';
            }
 
            if ($j < $fields_cnt - 1){
                $schema_insert .= $csv_separator;
            }
        } // end for

        $out .= $schema_insert;
        $out .= $csv_terminated;
    } // end while
 
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Length: " . strlen($out));
    // Output to browser with appropriate mime type, you choose ;)
    header("Content-type: text/x-csv");
    //header("Content-type: text/csv");
    //header("Content-type: application/csv");
    header("Content-Disposition: attachment; filename=$filename");
    echo $out;
    exit;
}
 
?>