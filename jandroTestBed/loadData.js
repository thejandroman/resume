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
            for(var i = 0; i < skills.length;i++) {
                $('ul').append('<li class="skill">' +
                                    skills[i].skill.name + '</li>');
            }
            //$('#skills:li').after('</ul>');
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

function submitPDF2(elem){
    var data1 = $(elem).html();
    $("form").submit(function(){
        $("input:hidden").val() = $(elem).html();
        document.myForm.submit();
    });
}

function submitPDF(elem) {
    var data1 = $(elem).html();
    //var data2 = data1.text();
    post_to_url("export.php", {"html" : data1});
    //$.post('export.php', {html : data1}, function(data){
    //var myWindow = window.open('', 'my div', 'height=400,width=600');
    //myWindow.document.write(data);
    //myWindow.document.close();
    //myWindow.print();
    //});
    //, function(data){
    //alert("Data Loaded: " + data);
    //});
    //$('#pdf').appemd('<pre>' + pdf.text() + '</pre>');
}

function post_to_url(path, params, method) {
    method = method || "post"; // Set method to post by default, if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
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
