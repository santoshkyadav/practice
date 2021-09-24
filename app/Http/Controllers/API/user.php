<?php  
  
   /* 
   * Following code will get single product details 
   * A product is identified by product id (pid) 
   */  
   require '../config.php';
   // array for JSON response  
   $response = array();  
  
   if (isset($_GET["uid"])) 
   {  
  
      $pid = $_GET['uid']; 
	  $pass= $_GET['pid'];	  
  
      $result = mysqli_query($conn, "SELECT * FROM mstcustomer WHERE Cust_Username = '$pid' and Cust_Password='$pass'");

         if (mysqli_num_rows($result) > 0)
		 {  
            $result = mysqli_fetch_assoc($result);  
            $AlbumDetail = array();  
            $AlbumDetail["CustomerName"] = $result["CustomerName"];  
            $AlbumDetail["FunctionDate"] = $result["FunctionDate"];
            $AlbumDetail["FunctionType"] = $result["FunctionType"];
            $AlbumDetail["AlbumName"] = $result["AlbumName"];
            $AlbumDetail["Remark"] = $result["Remark"];
            $AlbumDetail["studio_id"] = $result["studio_id"];  
  
            // success  
            $response["success"] = 1;  
  
            // user node  
            $response["users"] = array();  
            array_push($response["users"], $AlbumDetail);  
  
            // echoing JSON response  
            echo json_encode($response);  
         } 
		 else 
		 {  
            // no User found  
            $response["success"] = 0;  
            $response["message"] = "No Users found";
  
            // echo no users JSON  
            echo json_encode($response);  
         }  
	}    
?>  