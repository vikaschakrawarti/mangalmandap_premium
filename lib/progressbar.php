<?php      
       
        $DatabaseCo = new DatabaseConn();
        $SQL_STATEMENT =  "SELECT * FROM register_view WHERE matri_id='$mid'";
        $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
        $DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);     

{
    //photo 
    $photo1 = $DatabaseCo->dbRow->photo1;
    $photo2 = $DatabaseCo->dbRow->photo2;
    $photo3 = $DatabaseCo->dbRow->photo3;
    $photo4 = $DatabaseCo->dbRow->photo4;
    $photo5 = $DatabaseCo->dbRow->photo5;
    $photo6 = $DatabaseCo->dbRow->photo6;
    
    // Basic Details
    $fname = $DatabaseCo->dbRow->firstname;
    $lname = $DatabaseCo->dbRow->lastname;
    $mstatus = $DatabaseCo->dbRow->m_status;
    $mtongue = $DatabaseCo->dbRow->m_tongue;
    $bplace = $DatabaseCo->dbRow->birthplace;
    $btime = $DatabaseCo->dbRow->birthtime;
    $bdate = $DatabaseCo->dbRow->birthdate;
    $profileby = $DatabaseCo->dbRow->profileby;
    //$reference = $DatabaseCo->dbRow->reference;
    
    //Hobby and Profile Text
    $profile_text = $DatabaseCo->dbRow->profile_text;
    $hobby = $DatabaseCo->dbRow->hobby;
    
    //Education Details 
    $edu = $DatabaseCo->dbRow->edu_detail;
    $income = $DatabaseCo->dbRow->income;
    $occ = $DatabaseCo->dbRow->occupation;
    $emp = $DatabaseCo->dbRow->emp_in;
    
    //Contact Details
    //$address = $DatabaseCo->dbRow->address;
    $state = $DatabaseCo->dbRow->state_id;
    $city = $DatabaseCo->dbRow->city;
    $country = $DatabaseCo->dbRow->country_id;
    $mobile = $DatabaseCo->dbRow->mobile;
    //$phone = $DatabaseCo->dbRow->phone;
    //$timetocall = $DatabaseCo->dbRow->time_to_call;
    //$res_stat = $DatabaseCo->dbRow->residence; 
      
    //Social Attributes
    $religion = $DatabaseCo->dbRow->religion;
    $caste = $DatabaseCo->dbRow->caste;
   // $subcaste = $DatabaseCo->dbRow->subcaste;
    $horoscope = $DatabaseCo->dbRow->horoscope;
    $manglik = $DatabaseCo->dbRow->manglik;
    //$godhra = $DatabaseCo->dbRow->gothra;
    $star = $DatabaseCo->dbRow->star;
    $moonsing = $DatabaseCo->dbRow->moonsign;
    
    //Partner Preference
    $part_exp = $DatabaseCo->dbRow->part_expect;
    $looking_for = $DatabaseCo->dbRow->looking_for;
    $part_frm_age = $DatabaseCo->dbRow->part_frm_age;
    $part_to_age = $DatabaseCo->dbRow->part_to_age;
    $part_religion = $DatabaseCo->dbRow->part_religion;
    $part_caste = $DatabaseCo->dbRow->part_caste;
    $part_height = $DatabaseCo->dbRow->part_height;
    $part_height_to = $DatabaseCo->dbRow->part_height_to;
    $part_complexation = $DatabaseCo->dbRow->part_complexation;
    $part_edu = $DatabaseCo->dbRow->part_edu;
    $part_country_living = $DatabaseCo->dbRow->part_country_living;
    $part_resi_status = $DatabaseCo->dbRow->part_rasi;
    $part_mtongue = $DatabaseCo->dbRow->part_mtongue;
    
    //Family Details
    //$family_details = $DatabaseCo->dbRow->family_details;
    //$father_name = $DatabaseCo->dbRow->father_name;
    //$mother_name = $DatabaseCo->dbRow->mother_name;
    $father_occupation = $DatabaseCo->dbRow->father_occupation;
    $mother_occupation = $DatabaseCo->dbRow->mother_occupation;
    $no_of_sisters = $DatabaseCo->dbRow->no_of_sisters;
    //$family_origion = $DatabaseCo->dbRow->family_origin;
    $family_type = $DatabaseCo->dbRow->family_type;
    $family_status = $DatabaseCo->dbRow->family_status;
    $family_value = $DatabaseCo->dbRow->family_value;
    $no_of_brothers = $DatabaseCo->dbRow->no_of_brothers;
    $no_marri_brothers = $DatabaseCo->dbRow->no_marri_brother;
    $no_marri_sisters = $DatabaseCo->dbRow->no_marri_sister;

    $gender = $DatabaseCo->dbRow->gender;
    
    //Physical Attribute
    $height = $DatabaseCo->dbRow->height;
    $weight = $DatabaseCo->dbRow->weight;
    $physicalStatus = $DatabaseCo->dbRow->physicalStatus;
    $complexation = $DatabaseCo->dbRow->complexion;
    $bodytype = $DatabaseCo->dbRow->bodytype;

    $diet = $DatabaseCo->dbRow->diet;
    $drink = $DatabaseCo->dbRow->drink;
    $smoke = $DatabaseCo->dbRow->smoke;
    
    // Email Varification
    //$cpass_status = $DatabaseCo->dbRow->cpass_status;
    // Mobile Varification
    //$part_mtongue = $DatabaseCo->dbRow->moonsign;
}
// 19%
if($photo1 != '')   {    $photo1 = '14';   }else{    $photo1 = '0';       }
if($photo2 != '' && $photo3 != '' && $photo4 != '' && $photo5 != '' && $photo6 != '')   {    $photo2 = '5';   }else{    $photo2 = '0';       }

// 12%
if($fname != '' AND $lname != ''){  $fname = '2';  }else{  $fname = '0';  }
if($bdate != '')   {    $bdate = '2';    }else{    $bdate = '0';    }
if($mtongue != '')   {    $mtongue = '2';    }else{    $mtongue = '0';    }
if($gender != '')   {    $gender = '2';    }else{    $gender = '0';    }
if($mstatus != '')   {    $lname = '2';    }else{    $lname = '0';    }        
if($profileby != '')   {    $profileby = '2';    }else{    $profileby = '0';    }

// 5%
if($profile_text != '')   {    $profile_text = '5';    }else{    $profile_text = '0';    }

// 4%
if($religion != '')   {    $religion = '2';    }else{    $religion = '0';    }
if($caste != '')   {    $caste = '2';    }else{    $caste = '0';    }

// 8%
if($edu != '')   {    $edu = '2';    }else{    $edu = '0';    }
if($income != '')   {    $income = '2';    }else{    $income = '0';    }
if($occ != '')   {    $occ = '2';    }else{    $occ = '0';    }
if($emp != '')   {    $emp = '2';    }else{    $emp = '0';    }

// 12%
if($family_type != '')   {    $family_type = '2';    }else{    $family_type = '0';    }
if($family_status != '')   {    $family_status = '2';    }else{    $family_status = '0';    }
if($family_value != '')   {    $family_value = '2';    }else{    $family_value = '0';    }
if($father_occupation != '')   {    $father_occupation = '1';    }else{    $father_occupation = '0';    }
if($mother_occupation != '')   {    $mother_occupation = '1';    }else{    $mother_occupation = '0';    }
if($no_of_sisters != '')   {    $no_of_sisters = '1';    }else{    $no_of_sisters = '0';    }
if($no_of_brothers != '')   {    $no_of_brothers = '1';    }else{    $no_of_brothers = '0';    }
if($no_marri_brothers != '')   {    $no_marri_brothers = '1';    }else{    $no_marri_brothers = '0';    }
if($no_marri_sisters != '')   {    $no_marri_sisters = '1';    }else{    $no_marri_sisters = '0';    }

// 6%
if($state != '')   {    $state = '2';    }else{    $state = '0';    }
if($city != '')   {    $city = '2';    }else{    $city = '0';    }
if($country != '')   {    $country = '2';    }else{    $country = '0';    }

// 6%
if($diet != '')   {    $diet = '2';    }else{    $diet = '0';    }
if($drink != '')   {    $drink = '2';    }else{    $drink = '0';    }
if($smoke != '')   {    $smoke = '2';    }else{    $smoke = '0';    }


// 10%
if($height != '')   {    $height = '2';    }else{    $height = '0';    }
if($weight != '')   {    $weight = '2';    }else{    $weight = '0';    }
if($complexation!= '')   {    $complexation = '2';    }else{    $complexation = '0';    }
if($physicalStatus != '')   {    $physicalStatus = '2';    }else{    $physicalStatus = '0';    }
if($bodytype != '')   {    $bodytype = '2';    }else{    $bodytype = '0';    }

// 6%
if($looking_for != '')   {    $looking_for = '2';    }else{    $looking_for = '0';    }
if($part_frm_age != '' && $part_to_age!='')   {    $part_age = '2';    }else{    $part_age = '0';    }
if($part_height != '' && $part_height_to!='')   {    $part_height = '2';    }else{    $part_height = '0';    }

// 4%
if($part_religion != '')   {    $part_religion = '2';    }else{    $part_religion = '0';    }
if($part_caste != '')   {    $part_caste = '2';    }else{    $part_caste = '0';    }
  

// 6%
if($part_complexation != '')   {    $part_complexation = '1';    }else{    $part_complexation = '0';    }
if($part_edu != '')   {    $part_edu = '2';    }else{    $part_edu = '0';    }
if($part_country_living != '')   {    $part_country_living = '2';    }else{    $part_country_living = '0';    }
if($part_mtongue != '')   {    $part_mtongue = '2';    }else{    $part_mtongue = '0';    }

// 2%
if($part_exp != '')   {    $part_exp = '2';    }else{    $part_exp = '0';    }

//if($subcaste != '')   {    $subcaste = '1';    }else{    $subcaste = '0';    }
//if($horoscope != '')   {    $horoscope = '1';    }else{    $horoscope = '0';    }
//if($manglik != '')   {    $manglik = '1';    }else{    $manglik = '0';    }
//if($godhra != '')   {    $godhra = '1';    }else{    $godhra = '0';    }
//if($star != '')   {    $star = '1';    }else{    $star = '0';    }
//if($moonsing != '')   {    $moonsing = '1';    }else{    $moonsing = '0';    }
//if($bplace != '')   {    $bplace = '1';    }else{    $bplace = '0';    }
//if($btime != '')   {    $btime = '1';    }else{    $btime = '0';    }
//if($part_resi_status != '')   {    $part_resi_status = '1';    }else{    $part_resi_status = '0';    }

//  if($fname != '' AND $lname != '')    {     $fname = '2';     }else{     $fname = '0';        }        
//  if($mstatus != '')   {    $lname = '1';    }else{    $lname = '0';    }        
//  if($mtongue != '')   {    $mtongue = '1';    }else{    $mtongue = '0';    }
//  if($bplace != '')   {    $bplace = '1';    }else{    $bplace = '0';    }
//  if($btime != '')   {    $btime = '1';    }else{    $btime = '0';    }
//  if($bdate != '')   {    $bdate = '1';    }else{    $bdate = '0';    }
//  if($profileby != '')   {    $profileby = '1';    }else{    $profileby = '0';    }
//if($reference != '')   {    $reference = '1';    }else{    $reference = '0';    }

//if($hobby != '')   {    $hobby = '2';    }else{    $hobby = '0';    }         
    
//  if($state != '')   {    $state = '2';    }else{    $state = '0';    }
//  if($city != '')   {    $city = '2';    }else{    $city = '0';    }
//  if($country != '')   {    $country = '2';    }else{    $country = '0';    }
//  if($mobile != '')   {    $mobile = '2';    }else{    $mobile = '0';    }
    
//if($cpass_status != '')   {    $cpass_status = '8';    }else{    $cpass_status = '0';    }
         
         
        $hasCompletedBasic = ($fname+$lname+$mstatus+$mtongue+$bdate+$gender+$profileby);
        $hasCompletedProfileText = ($profile_text);
        $hasCompletedReligion = ($religion+$caste);
        $hasCompletedEdu = ($emp+$occ+$income+$edu);
        $hasCompletedFamily = ($family_type+$family_status+$family_value+$father_occupation+$mother_occupation+$no_of_sisters+$no_of_brothers+$no_marri_brothers+$no_marri_sisters);
        $hasCompletedLocation = ($state+$city+$country);
        $hasCompletedHabit = ($diet+$drink+$smoke);
        $hasCompletedPhysical = ($height+$weight+$physicalStatus+$complexation+$bodytype);
        $hasCompletedPart = ($part_exp+$looking_for+$part_age+$part_height+$part_religion+$part_caste+$part_complexation+$part_edu+$part_country_living+$part_mtongue);

        $hasCompletedPhoto = ($photo1+$photo2);
        
        $maximumPoints  = 100;

        $percentage = ($hasCompletedBasic+$hasCompletedProfileText+$hasCompletedReligion+$hasCompletedEdu+$hasCompletedFamily+$hasCompletedLocation+$hasCompletedHabit+$hasCompletedPhysical+$hasCompletedPart+$hasCompletedPhoto)*$maximumPoints/100;
        return $percentage;
// In the end print necessary code to the end of the html.
?>