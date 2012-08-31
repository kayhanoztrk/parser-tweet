<?php
/**
 * @file
 * Clears PHP sessions and redirects to the connect page.
 */
 
/* Load and clear sessions */

     session_start(); 
	  $filename=$_SESSION['filename'];
	  unset($_SESSION['filename']);
	@unlink($filename);


	  session_destroy();


 
/* Redirect to page with the connect to Twitter option. */
header('Location: ./connect.php');
