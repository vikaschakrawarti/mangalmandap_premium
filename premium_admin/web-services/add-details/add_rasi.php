<?php

include_once '../../../databaseConn.php';

include_once '../../lib/requestHandler.php';



$DatabaseCo = new DatabaseConn();

$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;

$rasi_id = isset($_POST['rasi_id']) ? $_POST['rasi_id'] :"" ;



$rasi_id = "";

$status="";



	

$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");

if($isPostBack)

{

		

	$statusObj = new Status();

	$errorFlag = false;

            $erroMessage = "";

            if(empty($_POST['rasi']))

			{

            	$erroMessage .= "<li>rasi should not be empty.</li>";

            	$errorFlag = true;

            }

			else

			{

            	if(strlen($_POST['rasi']) < 1)

				{

            		$erroMessage .= "<li>rasi Name should be atleast 2 characters.</li>";

            		$errorFlag = true;

            	}

            }

            if(empty($_POST['rasi_status']))

			{

			$erroMessage .= "<li>rasi Status should not be empty.</li>";

			$errorFlag = true;

          	}	

            if(!$errorFlag)

            {

				$rasi = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['rasi']);

				$status=		mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['rasi_status']);

				

    

            	$STATUS_MESSAGE="";

            

            	$SQL_STATEMENT = "";

            	switch($ACTION)

            	{

                    case 'ADD':

                   	 $SQL_STATEMENT = "INSERT into rasi (rasi,status)  values ('".$rasi."','".$status."')";



    

                            break;

                    case 'UPDATE':

                            $rasi_id = $_POST['rasi_id'];

                           $SQL_STATEMENT =  "UPDATE rasi set rasi='".$rasi."',status='".$status."' WHERE rasi_id=".$rasi_id;	

                            break;

                            

            }

    

             $statusObj = handle_post_request($ACTION,$SQL_STATEMENT,$DatabaseCo);

             $STATUS_MESSAGE = $statusObj->getStatusMessage();

	     

	     

	     $response = array();

	     $response['successStatus'] = $statusObj->getActionSuccess();

	     $response['responseMessage'] = $STATUS_MESSAGE;

	     header('Content-type: application/json');

	     echo json_encode($response);

	   	}

	   	else

	   	{

	   	 	

	     $response = array();

	     $response['successStatus'] = false;

	     $response['responseMessage'] = $erroMessage;

	     header('Content-type: application/json');

	     echo json_encode($response);	   		

	   	}

	   	

}



?>