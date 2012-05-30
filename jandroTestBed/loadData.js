function onLinkedInLoad() {
        IN.Event.on(IN, "auth", onLinkedInAuth);
}

function onLinkedInAuth() {
    window.location="resume.html";
}

function openCheck(elem) {
    var form = '<form action=""><input type=checkbox name="' + elem + '" />';
    return form;
}

function closeCheck() {
    var form = '</form>';
    return form;
}

function loadData() {
        IN.API.Profile("me")
        .fields(["id", "publicProfileUrl", "firstName", "lastName",
                 "pictureUrl", "headline", "positions", "skills",
                 "location:(name)","phone-numbers","main-address","educations"])

        .result(function(result) {
            // Name
            var formOpen = openCheck("name");
            var formClose = closeCheck();
            $('#name').html(formOpen + result.values[0].firstName + ' ' +
                            result.values[0].lastName + formClose);

            // Phone
            var formOpen = openCheck("phone");
            var formClose = closeCheck();
            var phoneNumberTotal = result.values[0].phoneNumbers._total;
            if (phoneNumberTotal==0) {
                $('#phone').html(formOpen + 'Phone Number' + formClose);
            } else {
                $('#phone').html(formOpen +
                                 result.values[0].phoneNumbers.values[0].phoneNumber
                                + formClose);
            }

            // Skills
            var formOpen = openCheck("skills");
            var formClose = closeCheck();
            var skills = result.values[0].skills.values;
            $('#skills').append(formOpen + '<ul>' + formClose);
            for(var i = 0; i < skills.length;i++) {
                $('ul').append('<li class="skill">' + formOpen +
                               skills[i].skill.name + formClose + '</li>');
            }

            // Positions
            var formOpen = openCheck("positions");
            var formClose = closeCheck();
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
                    location = ', <span class="location">' + location +
                        '</span>';
                }
                var startMonth = positions[i].startDate.month;
                var endMonth = positions[i].endDate ? positions[i].endDate.month
                    : '';
                if (startMonth==undefined && !endMonth) {
                    startMonth='';
                    endMonth='';
                } else {
                    startMonth=startMonth + '/';
                    endMonth=endMonth + '/';
                }
                $('#positions').after(formOpen +
                                      '<div class="job"><div class="job-header"><span class="title">'
                                      + positions[i].title.toUpperCase() +
                                      '</span>, <span class="company">' +
                                      positions[i].company.name + '</span>' +
                                      location + ', <span class="work-period">'
                                      + startMonth + positions[i].startDate.year
                                      + (positions[i].endDate ? ' - ' + endMonth
                                         + positions[i].endDate.year :
                                         ' - Present')
                                      + '</div><div class="job-detail">' +
                                      summary.replace(/\n/g, '<br />') +
                                      '</div></div>' + formClose);
            }

            // Education
            var formOpen = openCheck("education");
            var formClose = closeCheck();
            var educationsTotal = result.values[0].educations._total;
            if (educationsTotal>0) {
                var educations= result.values[0].educations.values;
            } else {
                var educations = "";
            }
            for(var i = educations.length-1; i >=0 ;i--)
            {
                $('#education').append('<br>' + formOpen + '<span id="degree">'
                                       + (educations[i].degree ?
                                        educations[i].degree : '') +
                                       (educations[i].fieldOfStudy ?
                                        (' in ' + educations[i].fieldOfStudy) :
                                        '') + '</span>' +
                                       (educations[i].degree ||
                                        educations[i].fieldOfStudy ? ' from ' :
                                        '') + '<span id="school">' +
                                       educations[i].schoolName +
                                       '</span><span id="graduation-date">' +
                                       (educations[i].endDate ?
                                        ((educations[i].endDate.year ? ' ,' +
                                          educations[i].endDate.year :
                                          'end year')) : '')  + '</span>' +
                                       formClose);
            }

            // Address
            $('#address').html(result.values[0].mainAddress);

        } );
}

function submitPDF(htmlDiv,css) {
    var data1 = $(htmlDiv).html();
    if(typeof css === 'undefined'){
        post_to_url("export.php", {"html" : data1});
        return;
    }
    var data2 = css;
    post_to_url("export.php", {"html" : data1 , "css" : data2});
}

function post_to_url(path, params, method) {
    method = method || "post";

    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}
