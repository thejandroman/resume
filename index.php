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
  *{font-size:12pt;font-family:Calibri;}
  #resume{width:612px;height:792px;padding:50px;padding-bottom:100px;border:1px solid #888888;}
  .position{font-weight:bold;}
  .position .summary{font-weight:normal;}
  .skill{margin:0px;}
  .skills{margin-bottom:20px;}
  #footer, #header{text-align:center;}
  #skills{margin-bottom:20px;}
  #phone, #name, #email{margin:0px 5px;}
  .position{margin-bottom:20px;}
  </style>
  <div id="profile"></div>
<div id="template"></div>
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
			var bracket_count = 0;
			//find the first open bracket
			//find the next bracket, if open, add to count, if closed, subtract from count
			//{templates:[{name:'educations.degree'}, {name:'educations.fieldOfStudy', ender:' from '}, {name:'educations.schoolName'}, {name:'educations.endDate.year'}]}
			var json_templates = new Array();
			var template_html = <?php echo "'".$template."'" ?>;
			var json_string = <?php echo "'".$template."'" ?> ;
			var json_string = json_string.substring(json_string.indexOf('{'));
			while (json_string.indexOf('}') > 0)
			{
				for (var i = 0; i < json_string.length; i++)
				{
					if (json_string[i] == '{') bracket_count++;
					if (json_string[i] == '}') bracket_count--;
					if (bracket_count == 0)
					{
						var json_template = json_string.substring(0, i + 1)
						json_templates.push($.parseJSON(json_template));
						json_string = json_string.substring(i + 1);
						json_string = json_string.substring(json_string.indexOf('{'));
						break;
					}
				}
			}
			for (var i = 0; i < json_templates.length; i++)
			{
				//document.write(JSON.stringify(json_templates[i]));
			}
			var profile = ''
			for (var i = 0; i < json_templates.length; i++)
			{
				var template_chunk = json_templates[i];
				var replacement = ''; //document.write(JSON.stringify(template_chunk));
				if ( !! template_chunk.template_group)
				{
					var template_chunk_beginner = template_chunk.template_group.beginner;
					var templates = template_chunk.template_group.templates;
					var template_chunk_ender = template_chunk.template_group.ender;
					var k = 0;
					while (values[templates[0].template.name][k] !== undefined)
					{
										replacement += (template_chunk_beginner ? template_chunk_beginner : '');

						for (var j = 0; j < templates.length; j++)
						{
							var template_beginner = templates[j].template.beginner;
							var name = templates[j].template.name;
							var template_ender = templates[j].template.ender;
							if (values[name]) replacement += (values[name][k] ? (template_beginner ? template_beginner : '') + values[name][k] + (template_ender ? template_ender : ''): '');
						}
						k++;
											replacement += (template_chunk_ender ? template_chunk_ender : '');

					}
				}
				else if ( !! template_chunk.template)
				{
					var template_beginner = template_chunk.template.beginner;
					var name = template_chunk.template.name;
					var template_ender = template_chunk.template.ender;
					var k = 0;
					while (values[name][k] !== undefined)
					{
						if (values[name])
						{
							replacement += (values[name][k] ? (template_beginner ? template_beginner : '') + values[name][k] + (template_ender ? template_ender : ''):'');
						}
						k++;
					}
				}
				else if ( !! template_chunk.name)
				{
					var name = template_chunk.name;
					var k = 0;
					if (values[name])
					{
						while (values[name][k] !== undefined)
						{
							replacement += values[name][k];
							k++;
						}
					}
				}
				var template_chunk_string = JSON.stringify(template_chunk);
				//alert(template_html);
				template_html = template_html.replace(template_chunk_string, replacement.replace(/&quot;/g, '"').replace(/;/g, '<br />'));
				//$('#template').html($('#template').html().replace(JSON.stringify(template_chunk), replacement));
				profile += template_chunk_string+ '<br />' + replacement.replace(/&quot;/g, '"') + '<br />';
			}
			$('#template').html(template_html);
			//$('#profile').html(profile);
		});
	});
}
     

  </script>
  </body>
  </html>
