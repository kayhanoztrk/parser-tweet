<?php 
 ob_start();
session_start(); 
require_once('twitteroauth/twitteroauth.php');
	 require_once('config.php'); 
	  require_once('include_fns.php');
	    
		   if(!$_GET['id'] || $_GET['id']=='')
		   {
		     header('Location:'.$_SERVER['HTTP_REFERER']);
			 }
			 else
			 {
			  $access_token = $_SESSION['access_token'];
			   $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
			   
			      $id=intval($_GET['id']);
				  $count_of_tweets=$_SESSION['statuses_count'];
			   if($connection->post('statuses/destroy',array('id'=>$id)))
			   {
			        $filename=$_SESSION['filename'];
				     unset($_SESSION['filename']);
					 unlink($filename);

                    
   
        
			     
				    header('Location:index.php');
				   } 
				   else
				   {
				       echo "Hata olustu kodlara göz at!"; 
					   }
					   }
ob_end_flush();
					   ?>
					   
					   
					   