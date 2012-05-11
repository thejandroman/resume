<?php include 'database.php';

$result = select_templates();
if($result===false)
	die(mysql_error());
$template = $result["template"];
?>
<html>
<head>
<script type="text/javascript" src="http://platform.linkedin.com/in.js">
api_key: j18qrld132fh
  authorize: true
  </script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script> 
  <script type="text/javascript">
      
  function loadData() {
    IN.API.Profile("me")
    .fields(["id", "publicProfileUrl", "firstName", "lastName",
             "pictureUrl", "headline", "positions", "skills","location:(name)","phone-numbers","main-address","educations"])
    .result(function(result) {
        //$("#profile").html(JSON.stringify(result));
		$('#template').html(<?php echo $template ?>);

			
      } );
  }

  </script>
</head>
<body>
<script type="in/Login" data-onAuth="loadData"></script>
  <style>
  /**{border:1px solid #888888;}*/
  *{font-size:12pt;}
  #resume{width:850px;padding:50px;padding-bottom:100px;border:1px solid #888888;}
  .job-header{font-weight:bold;}
  .skill{margin:0px;}
  #footer, #header{text-align:center;}
  .job{margin-bottom:20px;}
  #skills{margin-bottom:20px;}
  #phone, #name, #email{margin:0px 5px;}
  </style>
<div id="template">
  </div>
  </body>
  </html>
