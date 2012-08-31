<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

/* Load required lib files. */
 ob_start(); 
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');
require_once('include_fns.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
     
	  Header("Location:clearsessions.php"); 
	 
	  ?>
<?php }



/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
$content = $connection->get('account/verify_credentials');
 $_SESSION['username']=$content->screen_name;
 $_SESSION['statuses_count']= $content->statuses_count;
$count_of_tweets=$content->statuses_count;
$tim=strtotime($content->created_at);
$now=time();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>TweetParser</title>
	<link rel="stylesheet" href="css/stil.css"/>
	<link rel="stylesheet" href="css/default.css"/>
	<link rel="stylesheet" href="css/android.css"/>
	



</head>
<body>
	<!-- Header -->
	<div id="header"><div class="header">
		<div class="yazi">TweetParser &nbsp; &nbsp; &nbsp; <a href="./clearsessions.php">Logout</a></div>
		
	</div></div>
	<!--#Header -->
	<!-- Genel -->
	<div id="genel">
		
		<!-- Sağ -->
		<div id="sag">
			
			<!-- Takvim -->
			<div id="takvim">
			<form action="index.php" method="post" />
				<select name="secilen" class="tarih" id="tarih">
					<?php while($tim<=$now)
                    {?>
<option   value='<?php echo $tim;?>'><?php echo date("d/m/y",$tim);?></option>
<?php
   $tim+=60*60*24; 
}  ?>
				</select>
				
				<div class="button">
					<input type="submit" name="sub" value="Show my Tweets" class="tweet_buton" id="tweet_buton" />
				</div>
				</form>
				<div class="temiz"></div>
			</div>
		<?php	
$data[]=array();		
$data['twit']=array();
$data['date']=array(); 	
$data['id']=array();
		   
if(!isset($_SESSION['filename']) || $_SESSION['statuses_count']!=$count_of_tweets)
	      {
  
  
           $turning=ceil($count_of_tweets/200);
		   
		   for($i=1;$i<=16;$i++)
{
    

			  $owntweets=$connection->get('statuses/user_timeline',array('page'=>$i,'include_rts'=>1,'count'=>200));

          foreach ($owntweets as $display){
		 
		  
    array_push($data['twit'],utf8_encode($display->text));
    array_push($data['date'],date("d/m/y",strtotime($display->created_at)));
    array_push($data['id'],$display->id);

}
  $id=$display->id;
       }
			    
			
   $filename="path/".words_random(5).".xml"; 
   $_SESSION['filename']=$filename;
        
	create_file($filename);
				
	$fp=write_xml($data,$filename);
			   
			   }
			  
                 
                   
				 
						
		   ?>
		   
			<!--#Takvim -->
			<!-- Takvim Sağ -->
			<div id="tsag">
				<p>Bu uygulama seçtiğiniz tarihteki yazdığınız twittleri size gösterir ve böylece hangi tarihte ne yazmıssınız kolaylıkla
görebilirsiniz.İstersenizde twitter hesabınızda ilk tweetlerinize kadar inip, ugrasmadan tweetlerinizi silebilirsiniz.
 				</p>
				
			</div>
			<!--#Takvim Sağ -->
	<div class="temiz"></div>
		</div>
		<!--#Sağ -->


		
		<!--Sol -->
		<div id="sol">
			
			<!-- İmages -->
			<div class="img">
				<img src="<?php echo get_big_profile_image($content->screen_name);?>"  width="240" height="180" alt=""/>
			</div>
			<!--#İmages -->
			<!-- Sağ Tarafı -->
			<div class="avatar_sag">
				<span>Twitter Username:</span> <b><?php echo $content->screen_name;?></b><br />
				<span>Location:</span> <b><?php echo $content->location;?></b><br />
				<span>Your account created at:</span><b><?php echo date("d/m/Y",strtotime($content->created_at));?></b><br />
				<span>Followers Count:</span> <b><?php echo $content->followers_count;?></b><br />
				<span>Following count:</span> <b><?php echo $content->friends_count;?></b><br />
				<span>Tweets count:</span> <b><?php echo $content->statuses_count;?></b><br />
				
				
			</div>
			<!--#Sağ Tarafı -->
			<div class="temiz"></div>
		</div>
		<!--#Sol -->
	<div class="temiz"></div>
			<!-- Twit Listesi -->
		<div id="twit-list">
		<ul>
		 <?php 
		$filename=$_SESSION['filename'];
		
	read_xml_file($filename,strtotime($content->created_at));
		?>		
		</ul>
		</div>
		<!--#Twit Listesi -->
		<div class="temiz"></div>
	</div>
	
	<!--#Genel -->
	<!-- Footer -->
	<?php require_once'footer.php'; ?>
	<?php ob_end_flush(); ?>