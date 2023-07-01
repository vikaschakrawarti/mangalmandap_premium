<?php
error_reporting(0);
backup_tables();
function backup_tables($tables = '*') { 
    include_once '../databaseConn.php';
    include_once '../class/Config.class.php';
    $configObj = new Config();
    $DatabaseCo = new DatabaseConn();
    
    $db_name=$name;
    $abc=$DatabaseCo->dbLink; 
    $return='';          
    //get all of the tables 
    /*if($tables == '*')
    {
        $tables = array();
        $result = mysqli_query($abc, 'SHOW TABLES');
        while($row = mysqli_fetch_row($result))
        {   
            
            $tables[] = $row[0];
        }
        
        
    }
    else
    {
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }*/
    //print_r($tables);
    //cycle through 
    $tables=['admin_users','advertisement','age','bank_detail','block_profile','caste','chat','city','cms_pages','contact_checker','contact_view','contactus','country','country_code','dosh','education_detail','email_setting','email_templates','expressinterest','field_settings','first_form','franchies','frenchise_commision','height','income','matches','matches_list','membership_plan','menu_settings','messages','mothertongue','notification','occupation','online_users','payment_method','payment_view','payments','photoprotect_request','profile_by','rasi','register','religion','reminder','save_profile','save_search','shortlist','site_config','staff','star','state','sub_caste','success_story','who_viewed_my_profile','register_view','caste_view','state_view'];
    foreach($tables as $table) {
         
        $result = mysqli_query($abc,'SELECT * FROM '.$table);
        $num_fields = mysqli_num_fields($result);
        $row2 = mysqli_fetch_row(mysqli_query($abc,'SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";
        for ($i = 0; $i < $row = mysqli_fetch_row($result); $i++) { 
            $return.= 'INSERT INTO '.$table.' VALUES(';
                for($j=0; $j<$num_fields; $j++) { 
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = @preg_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; } 
                    if ($j<($num_fields-1)) { $return.= ','; } 
                } 
                $return.= ");\n";
        } 
    } 
    //save file 
    $now = date("F j, Y");
    $myfoldername = 'backup/';
    $handle = fopen($myfoldername.$now.'.sql','w+');
    fwrite($handle,$return);
    fclose($handle);
}
echo "<script>alert('Your database is stored in backup folder on your hosting file manager .');</script>";
echo "<script>window.location='DatabaseBackup';</script>";
?>