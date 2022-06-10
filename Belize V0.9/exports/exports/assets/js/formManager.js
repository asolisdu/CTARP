// listeners
$('input[type=radio][name=existingCustomerRadio]').change(function() {
    if (this.value.toUpperCase() == 'YES') {
        $('#customerIdCol').show();
    }
    else if (this.value.toUpperCase() == 'NO') {
        $('#customerIdCol').hide();
    }
});

$('#confirmCancelBtn').click(function(){
    window.location.reload();
});

// build form
function buildForm(){
    //console.log('building form');
    getLoanP();
    getLoanS();
    getSections();
    getCategories();
    getQuestionTypes();
    getQuestions();
}

// Business information 
function collectAnswers(type){

    var payloadContainer = new Object();
    var answersContainer = [];
    if(type == 'new'){
        // $('#ViewCPContentDiv').empty();
        // $('#viewCCContentDiv').empty();
        payloadContainer.assessment_id = newAssesmentObj.assessment.id;
    } else if (type == 'view'){
        // $('#MainCPContentDiv').empty();
        // $('#CCContentDiv').empty();
        payloadContainer.assessment_id = getUrlParameter('assessment_id');
    }
    

    var GenQuestions = questionsContainer.filter(obj => {
        return obj.section == 1 || obj.section == 2 || obj.section == 3;
    });

    
    
    
    ////console.log(GenQuestions);

    GenQuestions.forEach((question, key, arr) => {
        
        let curQContainer = new Object();
        let curQ = null;
        let curQType = typesContainer.filter(obj => {
            return obj.id === question.type;
        });
        
        switch (curQType[0].name) {

            case 'Dropdown Single':

                curQ = document.getElementById(question.id);  
                curQContainer.question_id = question.id;
                curQContainer.section_id = question.section;
                curQContainer.score = curQ.value;
                curQContainer.value = curQ.options[curQ.selectedIndex].text;
                curQContainer.scores = question.scores;
                curQContainer.recommendations = '';
                curQContainer.question_type = question.type;
                curQContainer.question_type_txt = curQType[0].name;
                curQContainer.questions = question.questions;
                answersContainer.push(curQContainer);
                
                break;

            case 'Checkbox group':

                curQ = $("input:radio[name="+question.id+"]:checked");
                curQContainer.question_id = question.id;
                curQContainer.section_id = question.section;
                curQContainer.score = curQ.val();
                curQContainer.value = curQ.next('label:first').html();
                curQContainer.scores = question.scores;
                if(document.getElementById(question.id)){
                    curQContainer.recommendations = document.getElementById(question.id).value;
                } else {
                    curQContainer.recommendations = '';
                }  
                curQContainer.question_type = question.type;
                curQContainer.question_type_txt = curQType[0].name;
                curQContainer.questions = question.questions;
                answersContainer.push(curQContainer);
                
                break;
            case 'Radio Group':

                curQ = $("input:radio[name="+question.id+"]:checked");
                curQContainer.question_id = question.id;
                curQContainer.section_id = question.section;
                curQContainer.score = curQ.val();
                curQContainer.value = curQ.next('label:first').html();
                curQContainer.scores = question.scores;
                if(document.getElementById(question.id)){
                    curQContainer.recommendations = document.getElementById(question.id).value;
                } else {
                    curQContainer.recommendations = '';
                }  
                curQContainer.question_type = question.type;
                curQContainer.question_type_txt = curQType[0].name;
                curQContainer.questions = question.questions;
                answersContainer.push(curQContainer);
                
                break;
            
            case 'Dropdown multiple':

                curQ = document.getElementById(question.id);  
                curQContainer.question_id = question.id;
                curQContainer.section_id = question.section;
                curQContainer.score = curQ.value;
                curQContainer.value = curQ.options[curQ.selectedIndex].text;
                curQContainer.scores = question.scores;
                curQContainer.recommendations = '';
                curQContainer.question_type = question.type;
                curQContainer.question_type_txt = curQType[0].name;
                curQContainer.questions = question.questions;
                answersContainer.push(curQContainer);
                
                break;

            case 'Climate Risk Card':

                // console.log('CRC');
                // console.log(question);
                var cleanTitle = question.title.replace(/\s/g, '');
                
                if(cleanTitle == 'Drought' ){
                    
                    curQ = document.getElementById('DroughtCardInput');
                    let riskValue = parseInt(curQ.value);
                    let cleanValues = question.questions.replace(/\s/g, '');
                    let riskValues = cleanValues.split("|");
                    let cleanScores = question.scores.replace(/\s/g, '');
                    let riskScores = cleanScores.split("|");
                    let riskIndex = riskValues.indexOf(riskValue.toString());

                    if(riskIndex !== -1){
                        curQContainer.score = riskScores[riskIndex];
                    } else {
                        curQContainer.score = 0;
                    }

                    curQContainer.question_id = question.id;
                    curQContainer.section_id = question.section;
                    curQContainer.value = 'DroughtCardInput';
                    curQContainer.scores = question.scores;
                    curQContainer.recommendations = '';
                    curQContainer.question_type = question.type;
                    curQContainer.question_type_txt = curQType[0].name;
                    curQContainer.questions = question.questions;
                    answersContainer.push(curQContainer);

                } else if (cleanTitle == 'Wildfires') {

                    curQ = document.getElementById('WildfiresCardInput');
                    // 
                    let riskValue = parseInt(curQ.value);
                    let cleanValues = question.questions.replace(/\s/g, '');
                    let riskValues = cleanValues.split("|");
                    let cleanScores = question.scores.replace(/\s/g, '');
                    let riskScores = cleanScores.split("|");
                    let riskIndex = riskValues.indexOf(riskValue.toString());

                    if(riskIndex !== -1){
                        curQContainer.score = riskScores[riskIndex];
                    } else {
                        curQContainer.score = 0;
                    }
                    // 
                    curQContainer.question_id = question.id;
                    curQContainer.section_id = question.section;
                    curQContainer.value = 'WildfiresCardInput';
                    curQContainer.scores = question.scores;
                    curQContainer.recommendations = '';
                    curQContainer.question_type = question.type;
                    curQContainer.question_type_txt = curQType[0].name;
                    curQContainer.questions = question.questions;
                    answersContainer.push(curQContainer);

                } else if (cleanTitle == 'Flooding') {

                    curQ = document.getElementById('FloodingCardInput');
                    // 
                    let riskValue = parseInt(curQ.value);
                    let cleanValues = question.questions.replace(/\s/g, '');
                    let riskValues = cleanValues.split("|");
                    let cleanScores = question.scores.replace(/\s/g, '');
                    let riskScores = cleanScores.split("|");
                    let riskIndex = riskValues.indexOf(riskValue.toString());

                    if(riskIndex !== -1){
                        curQContainer.score = riskScores[riskIndex];
                    } else {
                        curQContainer.score = 0;
                    }
                    // 
                    curQContainer.question_id = question.id;
                    curQContainer.section_id = question.section;
                    curQContainer.value = 'FloodingCardInput';
                    curQContainer.scores = question.scores;
                    curQContainer.recommendations = '';
                    curQContainer.question_type = question.type;
                    curQContainer.question_type_txt = curQType[0].name;
                    curQContainer.questions = question.questions;
                    answersContainer.push(curQContainer);

                } 
                
                break;

            default:
                ////console.log('ERROR Unidentified question type');
                break;
        }
        
        if(key === arr.length - 1){
            $('#assessmentSavedTxt').empty();

            payloadContainer.answers = answersContainer;
            ////console.log('>>ANSWERS<<<');
            ////console.log(payloadContainer);

            let settings = {
                "url": toolsURL+"_ins.php",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json",
                },
                "data": JSON.stringify(payloadContainer)
            }
            $.ajax(settings).done(function (response) {
                // ////console.log(response);<
                if(type == 'view'){
                    $( ".viewCancelBtn" ).trigger( "click" );
                } 

                let currentIndex = $('.carousel-item.active').index() + 1;
                
                if(currentIndex == 5 && type =='view'){
                    // buildReport(payloadContainer.assessment_id, type);
                    alert('Assessment#'+payloadContainer.assessment_id+' Saved Successfully')
                    location.reload();

                    for(var propt in response){
                        $('#assessmentSavedTxt').append(propt+': '+response[propt]+'<hr/>');
                    }
                    $('#assessmentSavedModal').modal('show');
                } else if (currentIndex == 5 && type =='new'){
                    window.location.href = '/viewAssessment.html?assessment_id='+payloadContainer.assessment_id+'&action=view';
                }  else {
                    $('.DataSavedToastTxt').text('Data for Assessment #'+response.assessment_id+' saved successfully');
                    $('.DataSavedToast').toast('show');
                }

              });
        }

    });
}

// ------------------ VIEW ASSESSMENT ------------------

// LISTENERS
$('.viewEditBtn').click(function(){
    
    $('.viewEditBtn').hide();
    $('.viewCancelBtn').show();
    $('.viewSaveBtn').show();
    
    // console.log('Edit');
    
    var x = document.getElementsByClassName("viewInput");
    var i;
    for (i = 0; i < x.length; i++) {
        x[i].disabled = false;
    }
});

$('.viewCancelBtn').click(function(){
    
    $('.viewEditBtn').show();
    $('.viewCancelBtn').hide();
    $('.viewSaveBtn').hide();
    
    // console.log('Cancel');
    
    var x = document.getElementsByClassName("viewInput");
    var i;
    for (i = 0; i < x.length; i++) {
        x[i].disabled = true;
    }
});

$('.viewSaveBtn').click(function(){
    collectAnswers('view');
});


function buildView(payload){
    return new Promise(function(resolve, reject) { 
        // console.log(payload);
        // var sample = payload.answers[0];
        var assessment = payload.assessment[0];
        var answers = payload.answers;
        var loan_purpose = payload.loan_purpose[0];
        var loan_section = payload.loan_section[0];

        // console.log('SAMPLE:');
        // console.log(sample);
        // setting existing customer && customer ID
        if(assessment.customer_id){
            $("input[name=view-existingCustomerRadio][value=" + 'yes' + "]").prop('checked', true);
            $("#view-customerIdCol").show();
            $("#view-customerId").val(assessment.customer_id);
        } else {
            $("input[name=view-existingCustomerRadio][value=" + 'no' + "]").prop('checked', true);
        }

        // CUSTOMER NAME 
        $("#view-customerNameInput").val(assessment.customer_first_name+' '+(assessment.customer_last_name ? assessment.customer_last_name : '')); 
        // CUSTOMER SEX
        assessment.sex ? $("input[name=view-customerRadioSex][value=" + assessment.sex + "]").prop('checked', true) : null;
        // CUSTOMER AGE
        $("#view-customerAgeInput").val(assessment.customer_age);
        // CUSTOMER LOAN PURPOSE
        $("#view-customerLoanPurposeTxt").text(loan_purpose.name);
        $("#view-BILoanPurposeTxt").text(loan_purpose.name);
        // CUSTOMER LOAN SECTOR
        $("#view-customerLoanSectorTxt").text(loan_section.name);
        $("#view-BILoanSectorTxt").text(loan_section.name);
        // CUSTOMER LOCATION
        $("#view-customerLocationAddress").val(assessment.address);
        // LAT LON
        $("#view-customerLocationLat").val(assessment.lat);
        $("#view-customerLocationLon").val(assessment.lon);    

        // SETTING IFRAME URL
        $('#viewIframe').attr('src', `/directions.html?lat=${assessment.lat}&lon=${assessment.lon}&z=10&pin=1&address=${escape(assessment.address)}`);
        // CLEAN CC CARDS CONTAINER
        $('#viewCCContentDiv').empty();

        
        setTimeout(() => {
            answers.forEach((element, index, array) => {
                // console.log(element.id);
                // console.log(element);
                switch (element.question_type) {
                    case "2":
                        document.getElementById(element.question_id).setAttribute("disabled", "disabled");
                        document.getElementById(element.question_id).value = parseFloat(element.score).toString();
                        document.getElementById(element.question_id).classList.add("viewInput");
                        break;
                    case "7":
                            var myEl = document.getElementById(element.question_id);
                            if(myEl){
                                myEl.value = element.recommendations;
                                myEl.disabled = true;
                                myEl.classList.add("viewInput");
                            }
                            if(element.score !== "0.00"){
                                x = document.getElementById('related'+element.related);
                                x.style.display = "block";
                            }
                        
                        try {
                            document.getElementsByName(element.question_id).forEach(e => {
                                e.classList.add("viewInput");
                                e.disabled = true;
                            });
                            document.querySelector('input[name="'+element.question_id+'"][value="'+parseFloat(element.score).toString()+'"]').checked = true;
                            break;
                        } 
                        catch ( e ) {
                            ////console.log('Error:',e);
                            // Code to run if an exception occurs
                            break;
                        }
                        
                        break;
                    case "8":
                            var myEl = document.getElementById(element.question_id);
                            if(myEl){
                                myEl.value = element.recommendations;
                                myEl.disabled = true;
                                myEl.classList.add("viewInput");
                            } 
                        try {
                            document.getElementsByName(element.question_id).forEach(e => {
                                e.classList.add("viewInput");
                                e.disabled = true;
                            });
                            document.querySelector('input[name="'+element.question_id+'"][value="'+parseFloat(element.score).toString()+'"]').checked = true;
                            
                            break;
                        } 
                        
                        catch ( e ) {
                            ////console.log('Error:',e);
                            // Code to run if an exception occurs
                            break;
                        }
                        
                        break;

                    case "9":

                        // console.log('CLIMATECARD');
                        buildCardView(assessment.lat, assessment.lon, assessment.address, element);
                        
                        break;
                    default:
                        break;
                }
                
                if(index == array.length-1){
                    resolve(true);
                }
                
            });
        }, 500);
    });

   
}
