function onLinkedInLoad() {
        IN.Event.on(IN, "auth", onLinkedInAuth);
}

function onLinkedInAuth() {
    window.location="step2.html";
}

function openForm(action){
    var form = '<form action="' + action + '">';
    return form;
}

function check(name) {
    var form = '<input type=checkbox name="' + name + '" checked="checked" />';
    return form;
}

function closeForm() {
    var form = '</form>';
    return form;
}

function buildResume() {
        IN.API.Profile("me")
        .fields(["id", "publicProfileUrl", "firstName", "lastName",
                 "pictureUrl", "headline", "positions", "skills",
                 "location:(name)","phone-numbers","main-address","educations"])
        .result(function(result) {

            // Add Full Name
            var fullName = result.values[0].firstName+' '+result.values[0].lastName;
            $('#name').attr('value',fullName);

            // Phone
            var phoneNumberTotal = result.values[0].phoneNumbers._total;
            if (phoneNumberTotal==0) {
                $('#phone').attr('placeholder','(555) 555-5555');
            } else {
                var phone = result.values[0].phoneNumbers.values[0].phoneNumber;
                $('#phone').attr('value',phone);
            }

            $('#address').autosize();

            // Skills
            var skills = result.values[0].skills.values;
            //$('#skills').attr('rows',skills.length)
            var allSkills='';
            for(var i = 0; i < skills.length;i++) {
                allSkills = allSkills + skills[i].skill.name + '\n';
            }
            $('#skills').attr('value',allSkills);
            $('#skills').autosize();

            // Positions
            var positions = result.values[0].positions.values;
            for(var i = positions.length - 1; i >=0  ;i--)
            {
                var summary = positions[i].summary;
                if (summary==undefined) {
                    summary = 'None';
                }
                var location = positions[i].location;
                if (location==undefined) {
                    location = '';
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
                $('#positions').prepend(
                    '<div class="clearfix"><a class="btn btn-danger pull-right btn-small" href="#">'
                        + '<i class="icon-minus-sign icon-white"></i> Remove this position</a></div>'
                        + '<div class="well" id="position' + i + '">'
                        + '<div class="controls controls-row">'
                        + '<div class="input-prepend"><span class="add-on">'
                        + '<i class="icon-star"></i></span>'
                        + '<input type="text" name="title" disabled value="'
                        + positions[i].title + '">'
                        + '<span class="help-inline">Title</span>'
                        + '</div><p>Start Date</p>'
                        + '<div class="input-prepend"><span class="add-on">'
                        + '<i class="icon-calendar"></i></span>'
                        + '<input type="text" name="startDate" readonly="readonly" value="'
                        + startMonth + positions[i].startDate.year + '">'
                        + '</div></div>'
                        + '<div class="row-fluid"><div class="span5"><p>Company</p>'
                        + '<div class="input-prepend"><span class="add-on">'
                        + '<i class="icon-briefcase"></i></span>'
                        + '<input type="text" name="company" class="span10" readonly="readonly" value="'
                        + positions[i].company.name + '">'
                        + '</div></div><div class="span5"><p>Location</p>'
                        + '<div class="input-prepend"><span class="add-on">'
                        + '<i class="icon-globe"></i></span>'
                        + '<input type="text" name="company" class="span10" readonly="readonly" value="'
                        + location + '">'
                        + '</div></div><div class="span2"><p>End Date</p>'
                        + '<div class="input-prepend"><span class="add-on">'
                        + '<i class="icon-calendar"></i></span>'
                        + '<input type="text" name="endDate" class="span10" readonly="readonly" value="'
                        + (positions[i].endDate ? '' + endMonth
                           + positions[i].endDate.year :
                           'Present') + '"></div></div></div>'
                        + '<div class="row-fluid">'
                        + '<div class="span12"><p>Summary</p>'
                        + '<textarea readonly="readonly" name="summary" class="span12">'
                        + summary + '</textarea>'
                        + '</div></div>');
            }
            $("textarea[name='summary']").autosize();

            // Education
            var educationsTotal = result.values[0].educations._total;
            if (educationsTotal>0) {
                var educations= result.values[0].educations.values;
            } else {
                var educations = "";
            }
            for(var i = educations.length-1; i >=0 ;i--)
            {
                $('#education').append(
                    '<div class="clearfix"><a class="btn btn-danger pull-right btn-small" href="#">'
                        + '<i class="icon-minus-sign icon-white"></i> Remove this degree</a></div>'
                    //degree+fieldOfStudy+school-name+end-date
                        + '<div class="well" id="education' + i + '">'
                        + '<div class="row-fluid"><div class="span4"><p>Degree</p>'
                        + '<div class="input-prepend"><span class="add-on">'
                        + '<i class="icon-bullhorn"></i></span>'
                        + '<input type="text" name="degree" class="span11" readonly="readonly" value="'
                        + (educations[i].degree ? educations[i].degree : '') + '" placeholder="Degree">'
                        + '</div></div><div class="span3"><p>Field of Study</p>'
                        + '<div class="input-prepend"><span class="add-on">'
                        + '<i class="icon-bullhorn"></i></span>'
                        + '<input type="text" name="degree" class="span11" readonly="readonly" value="'
                        + (educations[i].fieldOfStudy ? educations[i].fieldOfStudy : '') + '" placeholder="Field of Study">'
                        + '</div></div><div class="span3"><p>School Name</p>'
                        + '<div class="input-prepend"><span class="add-on">'
                        + '<i class="icon-bullhorn"></i></span>'
                        + '<input type="text" name="degree" class="span11" readonly="readonly" value="'
                        + (educations[i].schoolName ? educations[i].schoolName : '') + '" placeholder="School Name">'
                        + '</div></div><div class="span2"><p>Graduation Year</p>'
                        + '<div class="input-prepend"><span class="add-on">'
                        + '<i class="icon-calendar"></i></span>'
                        + '<input type="text" name="degree" class="span10" readonly="readonly" value="'
                        + (educations[i].endDate ? educations[i].endDate.year : '') + '" placeholder="Graduation Year">'
                        + '</div></div>'
                        + '</div></div>');
            }

            // Address
            //$('#address').html(result.values[0].main-address);

            var $window = $(window)
            // side bar
            $('.sideBarAffix').affix({
                offset: $('.sideBarAffix').position()
            });
            $('#resume').scrollspy();
            $('[data-spy="scroll"]').each(function () {
                var $spy = $(this).scrollspy('refresh')
            });
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

!function ($) {
    $(function(){

    })
}(window.jQuery);
