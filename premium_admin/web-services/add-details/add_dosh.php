<?php

include_once '../../../databaseConn.php';

include_once '../../lib/requestHandler.php';



$DatabaseCo = new DatabaseConn();

$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;

$dosh_id = isset($_POST['dosh_id']) ? $_POST['dosh_id'] :"" ;



$dosh_id = "";

$status="";



	

$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");

if($isPostBack)

{

		

	$statusObj = new Status();

	$errorFlag = false;

            $erroMessage = "";

            if(empty($_POST['dosh']))

			{

            	$erroMessage .= "<li>dosh should not be empty.</li>";

            	$errorFlag = true;

            }

			else

			{

            	if(strlen($_POST['dosh']) < 1)

				{

            		$erroMessage .= "<li>dosh Name should be atleast 2 characters.</li>";

            		$errorFlag = true;

            	}

            }

            if(empty($_POST['dosh_status']))

			{

			$erroMessage .= "<li>dosh Status should not be empty.</li>";

			$errorFlag = true;

          	}	

            if(!$errorFlag)

            {

				$dosh = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['dosh']);

				$status=		mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['dosh_status']);

				

    

            	$STATUS_MESSAGE="";

            

            	$SQL_STATEMENT = "";

            	switch($ACTION)

            	{

                    case 'ADD':

                   	 $SQL_STATEMENT = "INSERT into dosh (dosh,status)  values ('".$dosh."','".$status."')";



    

                            break;

                    case 'UPDATE':

                            $dosh_id = $_POST['dosh_id'];

                           $SQL_STATEMENT =  "UPDATE dosh set dosh='".$dosh."',status='".$status."' WHERE dosh_id=".$dosh_id;	

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