<?php 
session_start();
 require_once'include_fns.php'; 
   
      if(!empty($_POST['sele_date']))
	  {
	     $select_date=$_POST['sele_date']; 
		  read_xml_file($_SESSION['filename'],$select_date);
		  }
		  
   
   
						
	
	
	   
	   ?>
	   