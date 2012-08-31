<?php 
 
      function write_xml($data,$filename)
	  {
	    
		  //$twitter=$data;
		  $veri='';
	      for($you=0;$you<count($data['twit']);$you++)
		  {
		     
							   
							     $twitim=utf8_decode($data['twit'][$you]);
                                  $data_1="<tweets><tweet><![CDATA[{$twitim}]]></tweet>";

                                  $data_2="<date>{$data['date'][$you]}</date>";
                                  $data_3="<id>{$data['id'][$you]}</id>";
								 
                                   $veri.=$data_1."  ".$data_2."  ".$data_3."</tweets>";
								   
                                  
								  }
								  
								    
								  
								  
								 
					
               
	     $datalar="<?xml version='1.0' encoding='UTF-8'?>";
		 
$datalar.="<tweetparse>
           {$veri}
        

</tweetparse>";			   
			   $fp=@fopen($filename,"w") or die("You  haven't permissions about this xml file"); 
			   $res=fputs($fp,$datalar); 
			  if(!$res)
			  die(); 
			  return $fp;
			  }
			  
			  function words_random($uzunluk)
{
    $chars='abcdefghijklmnoprstuvyz';
	  $result=''; 
	  
	    for($i=0;$i<=$uzunluk;$i++)
		{
		     $result.=substr($chars,mt_rand(0,strlen($chars)-1),1); 
			 }
			   return $result; 
			   }
			   
			   function create_file($filename)
			 {
			   touch($filename);  
			   chmod ("$filename", 0777); 
			   } 
	
	function get_big_profile_image($username,$size = '') 
	{
  $api_call = 'http://twitter.com/users/show/'.$username.'.json';
  $results = json_decode(file_get_contents($api_call));
  
    return str_replace('_normal', $size, $results->profile_image_url);
   }

   
   function read_xml_file($filename,$selected_date)
{
   $xml=simplexml_load_file($filename);
                   $stra='';
				    $tweet_count=0;
			 foreach($xml->tweets as $tweets)
				   {   
                       //$tarih=(int)$tweets->date;
                        $tarih=(string)$tweets->date;
						
				        if($tarih==date("d/m/y",$selected_date) && $tweets->tweet!='')
						{   
						   ++$tweet_count;
						  $id=$tweets->id;
                         
				        $stra=$tweets->tweet.'   '.'<a href="delete_twit.php?id='.$id.'" class="delete">DELETE</a>'."<br />";						
		           echo '<li>'.$stra.'</li>';
						
					
						}
						else
						  {
						
						   }
						 
			}
			  if($tweet_count==0)
			  {
			    echo '<li><b>Bu tarihte hiç tweet atmamışsınız.</b></li>';  
			  }
}			
			   

			   
			  ?>
			  