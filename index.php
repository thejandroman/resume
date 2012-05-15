<?php include 'database.php';
$result = select_templates();
if($result === false)
	die(mysql_error());
	$templates = mysql_fetch_array($result,MYSQL_ASSOC);
	$template = $templates["template"];
?>
<html>
<head>
<script type="text/javascript" src="http://platform.linkedin.com/in.js">
/*api_key: j18qrld132fh
  authorize: true*/
  api_key: q166216s6ikx
  authorize: true
  </script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script> 
  <script type="text/javascript">
      //$(document).ready(function(){
  function loadData() {
    IN.API.Profile("me")
    .fields(["id", "publicProfileUrl", "firstName", "lastName",
             "pictureUrl", "headline", "positions", "skills","location:(name)","phone-numbers","main-address","educations"])
    .result(function(result) {
var values = new Array();
	function process(key,value,parent) {
	if(typeof(value)!='object')
	{
	var final_key = (parent+'.'+key).replace(/[^a-zA-Z.]+/g,'').replace('.values','').replace('..','.');
	//if(final_key.containis(.total))
	if(values[final_key] === undefined)
		values[final_key] = new Array();
	values[final_key].push(value);
	}
	
		
		
		
	}

function traverse(o,func, parent) {
    for (i in o) {
			func.apply(this,[i,o[i],parent]); 

        if (typeof(o[i])=="object") {
            traverse(o[i],func,parent + '.' + i);
        }
    }
}

//that's all... no magic, no bloated framework
traverse(result.values[0],process,'');

for(key in values)
{
	
}
for(key in values)
{
for(var i = 0; i < values[key].length; i++)
	{
		$('#resume').contents().filter(function() {
  return this.html().contains(key);
})
	}
}

/*
			$("#profile").html(JSON.stringify(result));
			$('#template').html(<?php echo "'".$template."'";?>);
			var skill = $('.skill').first();
			var education = $('.education').first();
			var position = $('.position').first();
			skill.remove();
			education.remove();
			position.remove();
			for(var i=0;i<result.values[0].skills._total;i++)
			{
				var this_skill = skill.clone();
				if(result.values[0].skills.values[i].skill.name)
					{
					var element = this_skill.children('.name').first();
					element.html(result.values[0].skills.values[i].skill.name + element.html());
				$('.skills').append(this_skill);
				}
			}
			for(var i=0;i<result.values[0].educations._total;i++)
			{
				var this_education = education.clone();
				if(result.values[0].educations.values[i].schoolName)
				{
				var element = this_education.children('.schoolName').first();
				element.html(result.values[0].educations.values[i].schoolName + element.html());
				}
				if(result.values[0].educations.values[i].degree)
				{
				var element = this_education.children('.degree').first();
				element.html(result.values[0].educations.values[i].degree + element.html());
				}
				if(result.values[0].educations.values[i].fieldOfStudy)
				{
				var element = this_education.children('.fieldOfStudy').first();
				element.html(result.values[0].educations.values[i].fieldOfStudy + element.html());
				}
				if(result.values[0].educations.values[i].endDate.year)
				{
var element = this_education.children('.endDate').first().children('.year').first();
				element.html(result.values[0].educations.values[i].endDate.year + element.html());
								}
				$('.educations').append(this_education);
			}
			for(var i=0;i<result.values[0].positions._total;i++)
			{
				var this_position = position.clone();
				if(result.values[0].positions.values[i].company.name)
				{
				var element = this_position.children('.company').first().children('.name').first();
				element.html(result.values[0].positions.values[i].company.name + element.html());
				}
				if(result.values[0].positions.values[i].startDate)
				{
				if(result.values[0].positions.values[i].startDate.month)
								{
				var element = this_position.children('.startDate').first().children('.month').first();
				element.html(result.values[0].positions.values[i].startDate.month + element.html());
				}
				if(result.values[0].positions.values[i].startDate.year)
				{
				var element = this_position.children('.startDate').first().children('.year').first();
				element.html(result.values[0].positions.values[i].startDate.year + element.html());
				}
				}
				if(result.values[0].positions.values[i].endDate)
				{
				if(result.values[0].positions.values[i].endDate.month)
								{
				var element = this_position.children('.endDate').first().children('.month').first();
				element.html(result.values[0].positions.values[i].endDate.month + element.html());
				}
				if(result.values[0].positions.values[i].endDate.year)
				{
				var element = this_position.children('.endDate').first().children('.year').first();
				element.html(result.values[0].positions.values[i].endDate.year + element.html());
				}
				}
				if(result.values[0].positions.values[i].summary)
								{
				var element = this_position.children('.summary').first();
				element.html(result.values[0].positions.values[i].summary + element.html());
				}
				if(result.values[0].positions.values[i].title)
								{
				var element = this_position.children('.title').first();
				element.html(result.values[0].positions.values[i].title + element.html());
				}
				$('.positions').append(this_position);
			}
			$('.firstName').text(result.values[0].firstName);
			$('.lastName').text(result.values[0].lastName);
			$('.mainAddress').text(result.values[0].mainAddress);
        });
  */});
}
  </script>
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
<div id="template"></div>
  </body>
  </html>
