<?php include 'database.php';
$result = select_templates();
if($result === false)
	die(mysql_error());
	$templates = mysql_fetch_array($result,MYSQL_ASSOC);
	$template = $templates["template"];
?>
<html>
<head>

</head>
<body>
<script type="in/Login" data-onAuth="loadData"></script>
  <style>
  /**{border:1px solid #888888;}*/
  *{font-size:12pt;}
  #resume{width:850px;padding:50px;padding-bottom:100px;border:1px solid #888888;}
  .position{font-weight:bold;}
  .position .summary{font-weight:normal;}
  .skill{margin:0px;}
  #footer, #header{text-align:center;}
  .job{margin-bottom:20px;}
  #skills{margin-bottom:20px;}
  #phone, #name, #email{margin:0px 5px;}
  </style>
  <div id="profile"></div>
<div id="template"><?php echo  "'".$template."'" ?></div>
<script type="text/javascript" src="http://platform.linkedin.com/in.js">
/*api_key: j18qrld132fh
  authorize: true*/
  api_key: q166216s6ikx
  authorize: true
  </script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script> 
  <script type="text/javascript">
  	function loadData()
	{
		IN.API.Profile("me").fields(["id", "publicProfileUrl", "firstName", "lastName", "pictureUrl", "headline", "positions", "skills", "location:(name)", "phone-numbers", "main-address", "educations"]).result(function (result)
		{
			var values = new Array();

			function process(key, value, parent)
			{
				if (typeof (value) != 'object')
				{
					var final_key = (parent + '.' + key).replace(/[^a-zA-Z.]+/g, '').replace('.values', '').replace('..', '.').substr(1);
					//if(final_key.containis(.total))
					if (values[final_key] === undefined) values[final_key] = new Array();
					values[final_key].push(value);
				}
			}

			function traverse(o, func, parent)
			{
				for (i in o)
				{
					func.apply(this, [i, o[i], parent]);
					if (typeof (o[i]) == "object")
					{
						traverse(o[i], func, parent + '.' + i);
					}
				}
			}
			//that's all... no magic, no bloated framework
			traverse(result.values[0], process, '');
			for (key in values)
			{
				for (var i = 0; i < values[key].length; i++)
				{
					//document.write(key + ':' + values[key][i] + '<br />')
				}
			}
			 $(document).ready(function ()
{

			var templates = $('#resume').html().match(/\[template:[a-zA-Z\.]+(\((.)+?\))*(\])/g); 
			for (var i = 0; i < templates.length; i++)
			{
				document.write(templates[i] + '<br />');
				var parameters = templates[i].match(/\((.)+?\)/g);
				var separator;
				var number_requested;
				if(parameters)
				{
					for(var j = 0; j < parameters.length; j++)
					{
					var parameter = parameters[j].toString().replace('(','').replace(')','');
					if(typeof(parameter)=="number")	
						number_requested = parameter;
					else
						separator = parameter;
					}
				}
				
				document.write('<br />');
			}
			
			// for (var i = 0; i < templates.length; i++)
			// {
							 // document.write(templates[i] + '<br />');

				// var parameters = templates[i].match(/\((.)+?\)/g);
				// if(parameters)
				// {
				// for(var j = 0; j < parameters.length; j++)
				// {
									 // document.write(parameters[j] + '<br />');

				// }
					// }						 document.write('<br />');

			// }

			for (key in values)
			{
				for (var i = 0; i < values[key].length; i++)
				{
					//$('#resume').html($('#resume').html().replace('[template:' + key+ ']',values[key][i]));
				}
			}
			//$("#profile").html(JSON.stringify(result));
			//$("#profile").html(templates.length);
			
		});
			});
			
			}
     

  </script>
  </body>
  </html>
