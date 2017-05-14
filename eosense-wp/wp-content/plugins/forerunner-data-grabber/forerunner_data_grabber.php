<?php
/*
 * @Package test package
 * @Author Patrick Williams
 */
 /*
  * Basic script with the intent of getting something to display maybe sort've, we should just try to
  * add to the database maybe
  */
  
  
  //On server side need to add the htmls
  function receivedRequest() 
  {
  		if($_SERVER["REQUEST_METHOD"] == "GET")
  		{
  			//Ahm.....print it out?
  			$request = $_GET['type'];
			if(!empty($request))
			{
				if($request == "upload_data")
				{
					//Let's say we have co2 low, temp and device id...yea
					$device_id = $_GET['dev_id'];
					$temp = $_GET['temp'];
					$co2 = $_GET['co2'];
					post_data($device_id, $temp, $co2);
					//Here we are going to go ahead and do some database stuff via the method
				}
				else if($request == "update_settings")
				{
					//Update setings, also going into the database
					echo "Updating settings";
				}
				else if($request == "fetch_data")
				{
					//Fetch data from the database and uh...retttttturn it? I think echo it...yea
					$device_id = $_GET['dev_id'];
					fetch_data($device_id);
				}
				else
				{
					//Must be the settings fetch
					echo "Fetching settings";
				}
				
			}
  		}	
  }
  
  
  /**
   * Fetches the data and then echos it out for now
   */
  function fetch_data($dev_id)
  {
  	$servername = "forerunnerresearch.netfirmmysql.com";
	$user="forerunner";
	$pass="caca123!!!";
	$dbname = "forerunner_research";
	
	try
	{
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Successful connection";
		$fetch_request = "SELECT DEVICE_HAS_DATA.timestamp, DEVICE_HAS_DATA.co2 FROM DEVICE_HAS_DATA WHERE DEVICE_HAS_DATA.device_id_fk = $device_id";
		$result = $conn->query($fetch_request);
	}
	catch(PDOException $e)
	{
		echo "Failed connect with message " . $e->getMessage();
	}
	
  }
  
  /**
   * Post data method, uploads one set of data to the server database
   */
  function post_data($dev_id, $temp, $co2)
  {
  	//We'll be using PDO format because while we are only using MySQL now, later we may
  	//switch database services
  	$servername = "forerunnerresearch.netfirmsmysql.com";
	$user = "forerunner";
	$pass = "caca123!!!";
	$dbname = "forerunner_research";
	//Attempting the connection here
	try
	{
		$connection = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Successful connection";
		//Now we could do the upload...I think should just be a simple sql statement
		$insertRequest = "INSERT INTO DEVICE_HAS_DATA VALUES ($dev_id, $temp, $co2)";
		$conn->exec($insertRequest);
		echo "Successfuly inserted data";
	}
	catch(PDOException $e)
	{
		echo "connection failed with message " . $e->getMessage();
	}
	$conn = null;
  }
  
  
  add_action('parse_request', 'receivedRequest');
?>