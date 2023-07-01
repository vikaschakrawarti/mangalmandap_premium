<?php

include_once '../../../databaseConn.php';

include_once '../../lib/requestHandler.php';



$DatabaseCo = new DatabaseConn();

$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;

$id = isset($_POST['id']) ? $_POST['id'] :"" ;



$id = "";

$status="";



	

$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");

if($isPostBack)

{

		

	$statusObj = new Status();

	$errorFlag = false;

            $erroMessage = "";

            if(empty($_POST['income']))

			{

            	$erroMessage .= "<li>Annual Income should not be empty.</li>";

            	$errorFlag = true;

            }

			else

			{

            	if(strlen($_POST['income']) < 1)

				{

            		$erroMessage .= "<li>Annual Income Name should be atleast 2 characters.</li>";

            		$errorFlag = true;

            	}

            }

            if(empty($_POST['income_status']))

			{

			$erroMessage .= "<li>income Status should not be empty.</li>";

			$errorFlag = true;

          	}	

            if(!$errorFlag)

            {

				$income = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['income']);

				$status=  mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['income_status']);

				

    

            	$STATUS_MESSAGE="";

            

            	$SQL_STATEMENT = "";

            	switch($ACTION)

            	{

                    case 'ADD':

                   	 $SQL_STATEMENT = "INSERT into income (income,status)  values ('".$income."','".$status."')";



    

                            break;

                    case 'UPDATE':

                            $id = $_POST['id'];

                           $SQL_STATEMENT =  "UPDATE income set income='".$income."',status='".$status."' WHERE id=".$id;	

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