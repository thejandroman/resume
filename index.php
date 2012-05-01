<?php include 'database.php' ?>
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

        // Header
        //var first_name = result.values[0].firstName;
        $('#name').html(result.values[0].firstName + ' ' + result.values[0].lastName);
        $('#email').html('singularityneuromancer@gmail.com'); // Can we pull this from the .raw() call?

        // Phone
        var phoneNumberTotal = result.values[0].phoneNumbers._total;
        if (phoneNumberTotal==0) {
          $('#phone').html('');
        } else {
          $('#phone').html(result.values[0].phoneNumbers.values[0].phoneNumber);
        }

        // Skills
        var skills = result.values[0].skills.values;
        $('#skills').append('<ul>');
        for(var i = 0; i < skills.length;i++)
          {
            $('#skills').append('<li class="skill">' + 
				skills[i].skill.name + '</li>');
          }
        $('#skills').append('</ul>');
        //var skills_html = $('#skills').html();
        //$('#skills').html(skills_html.substr(0,skills_html.length-2));

        // Positions
        var positions = result.values[0].positions.values;
        for(var i = positions.length - 1; i >=0  ;i--)
          {
            var summary = positions[i].summary;
            if (summary==undefined) {
              summary = '';
            }
            var location = positions[i].location;
            if (location==undefined) {
              location = '';
            } else {
              location = ', <span class="location">' + location + '</span>';
            }
            var startMonth = positions[i].startDate.month;
            var endMonth = positions[i].endDate ? positions[i].endDate.month : '';
            if (startMonth==undefined && !endMonth) {
              startMonth='';
              endMonth='';
            } else {
              startMonth=startMonth + '/';
              endMonth=endMonth + '/';
            }
            $('#positions').after('<div class="job"><div class="job-header"><span class="title">' +
                               positions[i].title.toUpperCase() + 
                               '</span>, <span class="company">' + 
                               positions[i].company.name + 
                               '</span>' + location + 
                               ', <span class="work-period">' +
                               startMonth + positions[i].startDate.year + (positions[i].endDate ? ' - ' + endMonth + positions[i].endDate.year : ' - Present') + 
                               '</div><div class="job-detail">' + 
                               summary.replace(/\n/g, '<br />') + '</div></div>');
          }

        // Education
        var educationsTotal = result.values[0].educations._total;
        if (educationsTotal>0) {
          var educations= result.values[0].educations.values;
        } else {
          var educations = "";
        }
        for(var i = educations.length-1; i >=0 ;i--)
          {
            $('#education').append('<br><span id="degree">' +
				(educations[i].degree ? educations[i].degree : '') + (educations[i].fieldOfStudy ? (' in ' + educations[i].fieldOfStudy) : '') 
				+ '</span>' + (educations[i].degree || educations[i].fieldOfStudy ? ' from ' : '')
				+ '<span id="school">'
				+ educations[i].schoolName
				+ '</span><span id="graduation-date">' +(educations[i].endDate ? ((educations[i].endDate.year ? ' ,' + educations[i].endDate.year : 'end year')) : '')  + '</span>');
          }

        // Address
        $('#address').html(result.values[0].mainAddress);
			
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
<div id="resume">
  <div id="resume_header"><span id="phone"></span>&nbsp;<span id="name"></span>&nbsp;<span id="email"></span></div>
  <div id="resume_body"><span id="skills"><br /><strong>Skills</strong></span>
  <span id="positions"><br><strong>Positions</strong></span></div>
  <div id="resume_footer"><span id="education"><strong>Education</strong></span><span id="address"></span></div>
  </div>
  </body>
  </html>
