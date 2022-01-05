<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);		
		$qry = $this->db->query("SELECT * FROM `membership` where mobile = '".$mobile."' and password = '".$password."' ");
		
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
					$_SESSION['name_'.$key] = $value;
					$_SESSION['mobile_'.$key] = $mobile;
			}
				return 1;
		}else{
			return 2;
		}
	}
	

    function logout()
        {
    		session_destroy();
    		foreach ($_SESSION as $key => $value) {
    			unset($_SESSION[$key]);
    		}
    		//header("location:login.php");
    		return 1;
    	}
     // 1--> new apoinment  0 --> fulfield  --->  2 --->canceled
	function new_appointment(){
	     	extract($_POST);
            $otp= rand(1111,9999);
            $date= date('d-m-Y H:i');
            $monthNum = date('m');;
            $monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
            $id=$_SESSION['login_id'];
            $rt=implode(", ",$requirement_type);
            if($id =='')
                {
                   $save = $this->db->query("INSERT INTO `book_appointment`(`id`, `mobile`,`requirement_type`,`order_info`,`otp`, `status`,`date_of_order`,`month_of_order`) VALUES ('','$mobile','$rt','$order_info','$otp','1','$date','$monthName')");
    		    }
           else
                {
              $mobile=$_SESSION['mobile_mobile'];
              $save = $this->db->query("INSERT INTO `book_appointment`(`id`,`uid`, `mobile`,`requirement_type`,`order_info`,`otp`, `status`,`date_of_order`,`month_of_order`) VALUES ('','$id','$mobile','$rt','$order_info','$otp','1','$date','$monthName')");
		        }
            
          $to      = "hosla.dalmadal@gmail.com";
            $subject = "New Requirement";
            $message = "
                                  Requirement - $rt  
                                    Mobile Number - $mobile 
                                  Personalized Service - $order_info 
                                    ";
    
    
            $headers =  'From:'."Hosla"       . "\r\n" .
                        'Reply-To: hosla.dalmadal@gmail.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
            
            mail($to, $subject, $message, $headers);

                    //   $fields = array(
                    //         "sender_id" => "TXTIND",
                    //         "message" => "your Reuirement  - $rt ",
                    //         "route" => "v3",
                    //         "numbers" => "$mobile",
                    //     );
                    //       $curl = curl_init();
                    //       curl_setopt_array($curl, array(
                    //       CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
                    //       CURLOPT_RETURNTRANSFER => true,
                    //       CURLOPT_ENCODING => "",
                    //       CURLOPT_MAXREDIRS => 10,
                    //       CURLOPT_TIMEOUT => 30,
                    //       CURLOPT_SSL_VERIFYHOST => 0,
                    //       CURLOPT_SSL_VERIFYPEER => 0,
                    //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    //       CURLOPT_CUSTOMREQUEST => "POST",
                    //       CURLOPT_POSTFIELDS => json_encode($fields),
                    //       CURLOPT_HTTPHEADER => array(
                    //         "authorization: RcSsKvX8n9fTZPDA4OuyW1CQxHelzktLhpGgdwBVYIU35EiFaMvnOXsSErKfgRUJzWtAcQbMIx9lkVL1",
                    //         "accept: */*",
                    //         "cache-control: no-cache",
                    //         "content-type: application/json"
                    //       ),
                    //     ));
                    //      $response = curl_exec($curl);
                    //     $err = curl_error($curl);
                    //     curl_close($curl);
                    
                    //    if ($err) {
                    //      echo "cURL Error #:" . $err;
                    //     } else {
                    //     echo $response;
                    //   }
    
                  
			         
			         
			
         	if($save){
			return 1;
		}
	}
    // New Membership
    function new_membership()
        {
            	     	 extract($_POST);
            	     	 $date     = date('d-m-Y H:i:s');
            	     	// $otp_Checking_date=date('d-m-Y');
            	     	//adding 10 minutes
                         $otp_expired = date('d-m-Y H:i:s', strtotime('+5 minutes', strtotime($date)));
                         $otp= rand(100000, 999999);
            	     	 $check  = $this->db->query("SELECT COUNT(*) AS `count`  FROM `membership` where `mobile`='$mobile' AND `login_verification` = '1' ")->fetch_object()->count;
            	        // $total_otp_check=$this->db->query("SELECT COUNT(*) AS `count`  FROM `membership` where `mobile`='$mobile'  AND  `date` LIKE '%$otp_Checking_date %' ");
            	     	
            	     	 if($check == '2')
            	     	 {
            	     	         //OTP Expired Validation For Second Time
            	     	         $expired_date  = $this->db->query("SELECT `otp_expired` FROM `membership` WHERE mobile='$mobile' ORDER BY id DESC LIMIT 1 ")->fetch_object()->otp_expired;
            	     	   	     $expired_date_timestamp = strtotime($expired_date);
                                 $convert_date = date('d-m-Y H:i:s', $expired_date_timestamp);
            	     	          if($date <=  $convert_date )
                                         {
            	     	                   // Fetch ID and Store into session
            	     	                   $last_id=$this->db->query("SELECT `id` FROM `membership` WHERE mobile='$mobile' ORDER BY id DESC LIMIT 1 ")->fetch_object()->id;
            	     	                   $_SESSION['last_id'] =$last_id;
            	     	                   return 3;
            	     	                   exist;
            	     	                 }
                                       else
                                         {
                                            $check=$this->db->query("SELECT `login_verification` FROM `membership` WHERE mobile='$mobile' ORDER BY id DESC LIMIT 1 ")->fetch_object()->login_verification;
                                             if($check=='0')
                                             {
                                                $save = $this->db->query("INSERT INTO `membership`(`id`, `name`, `mobile`,`password`,`address`, `resaon`,`otp`,`otp_expired`,`status`,`date`) VALUES ('','$name','$mobile','user123','$address','$resaon','$otp','$otp_expired','2','$date') ");
            	                                $last_id = mysqli_insert_id($this->db);
			                                    $_SESSION['last_id'] =$last_id;
                                                    if($save)
                                                          {
                                                           //OTP SEND TO MOBILE 
                                                           $fields = array(
                                                                "sender_id" => "TXTIND",
                                                                "message" => "$otp - is your one-time password valid for 5 minutes only  @https://hosla.in/ ",
                                                                "route" => "v3",
                                                                "numbers" => "$mobile",
                                                            );
                                                              $curl = curl_init();
                                                              curl_setopt_array($curl, array(
                                                              CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
                                                              CURLOPT_RETURNTRANSFER => true,
                                                              CURLOPT_ENCODING => "",
                                                              CURLOPT_MAXREDIRS => 10,
                                                              CURLOPT_TIMEOUT => 30,
                                                              CURLOPT_SSL_VERIFYHOST => 0,
                                                              CURLOPT_SSL_VERIFYPEER => 0,
                                                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                              CURLOPT_CUSTOMREQUEST => "POST",
                                                              CURLOPT_POSTFIELDS => json_encode($fields),
                                                              CURLOPT_HTTPHEADER => array(
                                                                "authorization: RcSsKvX8n9fTZPDA4OuyW1CQxHelzktLhpGgdwBVYIU35EiFaMvnOXsSErKfgRUJzWtAcQbMIx9lkVL1",
                                                                "accept: */*",
                                                                "cache-control: no-cache",
                                                                "content-type: application/json"
                                                              ),
                                                            ));
                                                            $response = curl_exec($curl);
                                                            $err = curl_error($curl);
                                                            curl_close($curl);
                            			                     return 1;
                            			                     exist;
                            		                      }
                                             }
                                             else
                                             {
                                                   return 2 ;
                	                               exist ; 
                                             }
                                            
                                         }
            	     	 }	
            	else   {
            	              
            	     	     $expired_date  = $this->db->query("SELECT `otp_expired` FROM `membership` WHERE mobile='$mobile' ORDER BY id DESC LIMIT 1 ")->fetch_object()->otp_expired;
            	     	     $expired_date_timestamp = strtotime($expired_date);
                             $convert_date = date('d-m-Y H:i:s', $expired_date_timestamp);
            	     	     if($date <=  $convert_date )

            	     	                 {
            	     	                   // Fetch ID and Store into session
            	     	                   $last_id=$this->db->query("SELECT `id` FROM `membership` WHERE mobile='$mobile' ORDER BY id DESC LIMIT 1 ")->fetch_object()->id;
            	     	                   $_SESSION['last_id'] =$last_id;
            	     	                   return 3;
            	     	                   exist;
            	     	                     
                                         }
                                       else
                                           {
                                 $save = $this->db->query("INSERT INTO `membership`(`id`, `name`, `mobile`,`password`,`address`, `resaon`,`otp`,`otp_expired`,`status`,`date`) VALUES ('','$name','$mobile','user123','$address','$resaon','$otp','$otp_expired','2','$date') ");
            	                 $last_id = mysqli_insert_id($this->db);
			                     $_SESSION['last_id'] =$last_id;
                                  if($save){
                                      
                                               //OTP SEND TO MOBILE 
                                                        $fields = array(
                                                                "sender_id" => "TXTIND",
                                                                "message" => "$otp - is your one-time password valid for 5 minutes only  @https://hosla.in/ ",
                                                                "route" => "v3",
                                                                "numbers" => "$mobile",
                                                            );
                                                              $curl = curl_init();
                                                              curl_setopt_array($curl, array(
                                                              CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
                                                              CURLOPT_RETURNTRANSFER => true,
                                                              CURLOPT_ENCODING => "",
                                                              CURLOPT_MAXREDIRS => 10,
                                                              CURLOPT_TIMEOUT => 30,
                                                              CURLOPT_SSL_VERIFYHOST => 0,
                                                              CURLOPT_SSL_VERIFYPEER => 0,
                                                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                              CURLOPT_CUSTOMREQUEST => "POST",
                                                              CURLOPT_POSTFIELDS => json_encode($fields),
                                                              CURLOPT_HTTPHEADER => array(
                                                                "authorization: RcSsKvX8n9fTZPDA4OuyW1CQxHelzktLhpGgdwBVYIU35EiFaMvnOXsSErKfgRUJzWtAcQbMIx9lkVL1",
                                                                "accept: */*",
                                                                "cache-control: no-cache",
                                                                "content-type: application/json"
                                                              ),
                                                            ));
                                                            $response = curl_exec($curl);
                                                            $err = curl_error($curl);
                                                            curl_close($curl);
                                                            return 1;
                            			                    exist;
                            		        }
                            		         }
            	   	 
                   	    }
         		
    	}
    // OTP Check For New Membership 
    function OTP_MEMBERSHIP()
    	{
                extract($_POST);
                $id=     $_SESSION['last_id'] ;
                $date     = date('d-m-Y H:i:s');
                $check = $this->db->query("SELECT `otp`  FROM `membership` where   `id`= '$id'")->fetch_object()->otp;
                if($check == $otp)
                {
                    $expired_date  = $this->db->query("SELECT `otp_expired` FROM `membership` WHERE `id`='$id' ORDER BY id DESC LIMIT 1 ")->fetch_object()->otp_expired;
            	    $expired_date_timestamp = strtotime($expired_date);
                    $convert_date = date('d-m-Y H:i:s', $expired_date_timestamp);
            	     if($date <=  $convert_date )
                            {
            	     	      $save = $this->db->query("UPDATE `membership` SET `login_verification`='1' , `otp_expired`='$date'   WHERE `id`='$id' ");
                	          unset($_SESSION['last_id']);
                	          return 1;
                	          exit; 
            	     	    }
                     else  {
                             unset($_SESSION['last_id']);
                	         return 3;
                	         exit;
                           }
                 }
                   else
                	{
                	   return 2;
                       exit;
                	}

  	    }
    //care_parent
    function care_parent()
        {
    	     	extract($_POST);
    	        $date= date('d-m-Y H:i');
    	        $check  = $this->db->query("SELECT `mobile`  FROM `membership` where `mobile`='$mobile' ")->fetch_object()->mobile;
                if($check==$mobile)
            	  {
            	     return 2;
            	     exit;
                  }
    	     else {	 
    	     	 $rt=implode("," ,$requirement_type);
    	     	$save = $this->db->query("INSERT INTO `care_parent`(`id`, `name`, `mobile`, `address`, `pname`, `pmobile`, `requirement_type`,`date`) VALUES ('','$name','$mobile','$address','$pname','$pmobile','$rt','$date')");
    		        //  send mail to admin 
                $to      = "hosla.dalmadal@gmail.com";
                $subject = "Offspring Care for Parents";
                $message = "
                                           Name - $name  
                                           Mobile Number - $mobile 
                                           Address  -  $address
                                           Parents Names - $pname 
                                           Parents Contact Number - $pmobile
                                           Services - $rt
                                       
                             ";
        
        
                $headers =  'From:'."Hosla"       . "\r\n" .
                            'Reply-To: hosla.dalmadal@gmail.com' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();
              //  mail($to, $subject, $message, $headers);
    	  if($save){
    			  return 1;
    		       }
    	       }
    
    
    	}
}