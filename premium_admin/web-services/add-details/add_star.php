<?php

include_once '../../../databaseConn.php';

include_once '../../lib/requestHandler.php';



$DatabaseCo = new DatabaseConn();

$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;

$star_id = isset($_POST['star_id']) ? $_POST['star_id'] :"" ;



$star_id = "";

$status="";



	

$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");

if($isPostBack)

{

		

	$statusObj = new Status();

	$errorFlag = false;

            $erroMessage = "";

            if(empty($_POST['star']))

			{

            	$erroMessage .= "<li>Star should not be empty.</li>";

            	$errorFlag = true;

            }

			else

			{

            	if(strlen($_POST['star']) < 1)

				{

            		$erroMessage .= "<li>Star Name should be atleast 2 characters.</li>";

            		$errorFlag = true;

            	}

            }

            if(empty($_POST['star_status']))

			{

			$erroMessage .= "<li>Star Status should not be empty.</li>";

			$errorFlag = true;

          	}	

            if(!$errorFlag)

            {

				$star = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['star']);

				$status=		mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['star_status']);

				

    

            	$STATUS_MESSAGE="";

            

            	$SQL_STATEMENT = "";

            	switch($ACTION)

            	{

                    case 'ADD':

                   	 $SQL_STATEMENT = "INSERT into star (star,status)  values ('".$star."','".$status."')";



    

                            break;

                    case 'UPDATE':

                            $star_id = $_POST['star_id'];

                           $SQL_STATEMENT =  "UPDATE star set star='".$star."',status='".$status."' WHERE star_id=".$star_id;	

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