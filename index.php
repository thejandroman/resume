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
		var used_values = new Array();
		var resume_template = {};
		$(document).ready(function ()
		{
			//var templates = $('#resume').html().match(/\[\[[template:[a-zA-Z\.]+(\((.)+?\))*(\]\])/g); 
			var templates = $('#resume').html().match(/\[\[(.)*?template:(.)*?\]\]/g);
			for (var i = 0; i < templates.length; i++)
			{
				if (resume_template[templates[i]] === undefined) resume_template[templates[i]] = new Array();
				//document.write(templates[i] + '<br />');
				var fudged_template = templates[i].match(/\[(.)*?template:(.)*?\]/g);
				var replacement = ''
				for (var j = 0; j < fudged_template.length; j++)
				{
					var template = fudged_template[j].replace('[[', '[').replace(']]', ']');
					var parameters = template.match(/\((.)+?\)/g);
					var beginner = '';
					var ender = '';
					if (parameters)
					{
						if (parameters[1])
						{
							beginner = parameters[0].replace('(', '').replace(')', '');
							ender = parameters[1].replace('(', '').replace(')', '');
						}
						else ender = parameters[0].replace('(', '').replace(')', '');
					}
					var template_name = template;
					template_name = template_name.substring(template_name.indexOf('template:')+9);
					if(template_name.indexOf('(') != -1)
					{
						template_name = template_name.substring(0, template_name.indexOf('('));
					}
					else
					{
						template_name = template_name.replace(']','');
					}

					resume_template[templates[i]].push(
					{
						beginner: beginner,
						ender: ender,
						template: template,
						template_name: template_name
					});
				}
				//document.write(templates[i] + '<br/ >' + replacement + '<br />');
				//$('#resume').html($('#resume').html().replace(templates[i], replacement));
				//document.write(templates[i]);
			}
			var profile = ''
			//$('#profile').html($('#resume').html());
			for (key in resume_template)
			{
				var replacement = '';
				var j = 0;
				//for each super-template, see if its first entry template has a value at the value index
				while (!!values[resume_template[key][0].template_name] && !!values[resume_template[key][0].template_name][j])
				{
					for (var i = 0; i < resume_template[key].length; i++)
					{
					if(values[resume_template[key][i].template_name])
							replacement += (resume_template[key][i].beginner ? resume_template[key][i].beginner : '') + (values[resume_template[key][i].template_name][j] ? values[resume_template[key][i].template_name][j] : '') + (resume_template[key][i].ender ? resume_template[key][i].ender : '');
					}
					j++;
				}
				$('#resume').html($('#resume').html().replace(key, replacement));
			}
			for (key in values)
			{
				for (var i = 0; i < values[key].length; i++)
				{
					//profile += key + '<br />' + values[key][i] + '<br />';
				}
			}
			for (key in resume_template)
			{
				//profile += "key: " + key + '<br />';
				for (var i = 0; i < resume_template[key].length; i++)
				{
					profile += 'resume_template[key][i]: '+ (resume_template[key][i].beginner ? resume_template[key][i].beginner : '') + resume_template[key][i].template_name +(resume_template[key][i].ender ? resume_template[key][i].ender : '') +  '<br />';
				}
			}
			$('#profile').html(profile);
		});
	});
}
     

  </script>
  </body>
  </html>
