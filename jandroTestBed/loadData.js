function onLinkedInLoad() {
        IN.Event.on(IN, "auth", onLinkedInAuth);
}

function onLinkedInAuth() {
    window.location="resume.html";
}

function loadData() {
        IN.API.Profile("me")
        .fields(["id", "publicProfileUrl", "firstName", "lastName",
                 "pictureUrl", "headline", "positions", "skills","location:(name)","phone-numbers","main-address","educations"])
        .result(function(result) {
            //$("#profile").html(JSON.stringify(result));

            // Header
            //var first_name = result.values[0].firstName;
            $('#name').html(result.values[0].firstName + ' ' + result.values[0].lastName);
            //$('#email').html('singularityneuromancer@gmail.com'); // Can we pull this from the .raw() call? Nope. We can't

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

function submitPDF(elem) {
    $.post('export.php', $(elem).text());
}
