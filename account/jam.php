<?
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', 'logs/error.log');
?>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://code.jquery.com/resources/demos/style.css">
<script src="http://code.jquery.com/jquery-1.3.2.min.js"></script>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>
 $(document).ready(function() 
{
      
$("#responsecontainer").load("jam-refresh.php");
   
var refreshId = setInterval(function() 
      
{
      
$("#responsecontainer").load('jam-refresh.php?randval='+ Math.random());
}, 1000);
                               
});
</script>
<div id="responsecontainer">
</div></div></div>
</div>
</div>
