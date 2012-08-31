<div id="footer">
		<div class="footer">
			<p>All Right Reserved &copy; 2012 - TweetParser - Kayhan Öztürk</p>
		</div>
	</div>
	<!--#Footer -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script type="text/javascript">
$(document).ready(function(){
  $("#tweet_buton").click(calis); 
  $(".delete").click(delete_tweets);
  }); 
  function calis()
  {
	  var tarih_text=$("#tarih option:selected").val(); 
	
    if(tarih_text=='')
	{} 
	  else
	   {
	     $.ajax({
		     type:'POST',
			 url:'index_submit.php', 
			 data:'sele_date='+tarih_text, 
			 success:function(msg)
			 {
			  $("#twit-list ul ").html(msg);
			      }
		 
	      });
		  }
	
  return false;
	  }
	  
	    function delete_tweets()
		{
		  
		    }
	  
	  
</script>
		  
</body>
</html>
