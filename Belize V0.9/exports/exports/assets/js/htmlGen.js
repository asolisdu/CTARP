var sectionsContainer = [], questionsContainer = [], categoriesContainer, typesContainer, CCGenQuestions;

// loan purposes
function getLoanP(){    
    //console.log('Loan Purposes');
    var settings = {
        "url": apiURL+"?action=list&object=loan_purposes",
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Authorization": "Bearer "+gToken
        },
    };

    if(localStorage.getItem("loanPurposes") === null) {
        $.ajax(settings).done(function (response) {
            // SAVING INTO LOCAL STORAGE 
            localStorage.setItem('loanPurposes', JSON.stringify(response.loan_purposes));
                buildLoanPurposesDropDowns(response.loan_purposes);        
            });
    } else {
        //console.log('optimizing loan purposes');
        buildLoanPurposesDropDowns(JSON.parse(localStorage.getItem("loanPurposes")));    
    }
 
}

function buildLoanPurposesDropDowns(array){
    // console.log('BUILD LOAN PUR');
    // console.log(array);
    let objContainer = [];
        
    array.forEach((element, key, arr) => {
        let option = new Object();
        option.id = element.id;
        option.val = element.name;
        option.value = element.name;
        option.title = element.name;
        objContainer.push(option);

        if(key === arr.length - 1){
            dropdownSingle('customerLoanPurposeSelect','Loan Purposes', objContainer);
            dropdownSingle('view-customerLoanPurposeSelect','Loan Purposes', objContainer);
        }
    });
}

// loan sectors
function getLoanS(){      
    var settings = {
        "url": apiURL+"?action=list&object=loan_section",
        "method": "GET",
        "timeout": 0,
        "headers": {
          "Authorization": "Bearer "+gToken
        },
      };

    if(localStorage.getItem("loanSectors") === null) {
        $.ajax(settings).done(function (response) {
            // SAVING INTO LOCAL STORAGE 
            localStorage.setItem('loanSectors', JSON.stringify(response.loan_section));
                buildLoanSectorsDropdowns(response.loan_section);        
        });
    } else {
        ////console.log('optimizing loan sectors');
        buildLoanSectorsDropdowns(JSON.parse(localStorage.getItem("loanSectors")));    
    }
}

function buildLoanSectorsDropdowns(array){
    let objContainer = [];
        
    array.forEach((element, key, arr) => {
        let option = new Object();
        option.id = element.id;
        option.val = element.name;
        option.title = element.name;
        objContainer.push(option);

        if(key === arr.length - 1){
            // ////console.log(objContainer);
            dropdownSingle('customerLoanSectorSelect','Loan Sectors', objContainer);
            dropdownSingle('view-customerLoanSectorSelect','Loan Sectors', objContainer);
        }
    });
}

function getSections(){
    var settings = {
        "url": apiURL+"?action=list&object=sections",
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Authorization": "Bearer "+gToken
        },
    };
      
    if(localStorage.getItem("sections") === null) {
        $.ajax(settings).done(function (response) {
            // SAVING INTO LOCAL STORAGE 
            localStorage.setItem('sections', JSON.stringify(response.sections));
            buildSections(response.sections);        
        });
    } else {
        ////console.log('optimizing sections');
        buildSections(JSON.parse(localStorage.getItem("sections")));    
    }

}

function buildSections(sections){
    sections.forEach((element, key, arr) => {
        let section = new Object();
        section.title = element.title;
        section.id = element.id;
        section.order = element.order;
        sectionsContainer.push(section);

        if(key === arr.length - 1){
            // ////console.log(sectionsContainer);
        }
    });
}

function getQuestions(){
    var settings = {
        "url": apiURL+"?action=list&object=questions",
        "method": "GET",
        "timeout": 0,
        "headers": {
          "Authorization": "Bearer "+gToken
        },
      };

    if(localStorage.getItem("questions") === null) {
    $.ajax(settings).done(function (response) {
        // SAVING INTO LOCAL STORAGE 
        localStorage.setItem('questions', JSON.stringify(response.questions));
            buildQuestionsContainer(response.questions);        
        });
    } else {
        ////console.log('optimizing questions');
        buildQuestionsContainer(JSON.parse(localStorage.getItem("questions")));    
    }

}

function buildQuestionsContainer(questions){
    questions.forEach((element, key, arr) => {
            
        let question = new Object();
        
        question.title = element.title,
        question.id = element.id,
        question.active = element.active,
        question.category = element.category,
        question.group = element.group,
        question.has_recommendations = element.has_recommendations,
        question.placeholder = element.placeholder,
        question.questions = element.questions,
        question.scores = element.scores,
        question.section = element.section,
        question.type = element.type;
        question.trigger_related_val = element.trigger_related_val;
        question.related = element.related;
        questionsContainer.push(question);

        if(key === arr.length - 1){
            ////console.log(questionsContainer);
            buildBI();
            buildCC();
        }
    });
}

function getCategories(){
    var settings = {
        "url": apiURL+"?action=list&object=question_category",
        "method": "GET",
        "timeout": 0,
        "headers": {
          "Authorization": "Bearer "+gToken
        },
      };
      
      $.ajax(settings).done(function (response) {

        // ////console.log(response);

        categoriesContainer = response.question_category;
        
        // ////console.log('categories');
        // ////console.log(categoriesContainer);

      });
}

function getQuestionTypes(){
    var settings = {
        "url": apiURL+"?action=list&object=question_types",
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Authorization": "Bearer "+gToken
        },
    };

    if(localStorage.getItem("questionTypes") === null) {
        $.ajax(settings).done(function (response) {
            // SAVING INTO LOCAL STORAGE 
            localStorage.setItem('questionTypes', JSON.stringify(response.question_types));
            typesContainer = response.question_types;
        });
    } else {
        ////console.log('optimizing loan purposes');
        typesContainer = JSON.parse(localStorage.getItem("questionTypes"));    
    }

}

function buildBI(){

    var BIQuestions = questionsContainer.filter(obj => {
        return obj.section == 1;
    })

    // ////console.log('BiQuestions');
    // ////console.log(BIQuestions);

    var BI_HTML = [];
    var relatedListenersId = [];

    BIQuestions.forEach((question, key, arr) => {
        let type = typesContainer.filter(obj => {
            return obj.id === question.type;
          });

        if(question.related){
            var tempObj = new Object();
            tempObj.related = question.related;
            tempObj.trigger_related_val = question.trigger_related_val
            relatedListenersId.push(tempObj);
        }
        
        
        // ////console.log(type[0].name);
        switch (type[0].name) {
            case 'Dropdown Single':
                ////console.log('dropdown');
                BI_HTML.push(dropDownSingle2(question));
                break;
            case 'Text field':
                ////console.log('text field');
                break;
            case 'Integer':
                ////console.log('integer');
                break;
            case 'Number':
                ////console.log('number');
                break;
            case 'Checkbox group':
                ////console.log('checkbox group');
                BI_HTML.push(checkBox(question));
                break;
            case 'Radio Group':
                BI_HTML.push(radioGroup(question));
                ////console.log('radio group');
                break;
            case 'Climate Risk Card':
                ////console.log('climate risk card');
                break;
            case 'Dropdown multiple':
                ////console.log('drop down mul');
                BI_HTML.push(dropdownSingle2(question));
                break;
            case 'Geolocation':
                ////console.log('geo');
                break;
            case 'Range selector slider':
                ////console.log('sel slider');
                break;
            case 'Range Selector Radio':
                ////console.log('range sel');
                break;
            case 'Date Range':
                ////console.log('date range');
                break;
            case 'Date Selector':
                ////console.log('date sel');
                break;
            case 'Title':
                ////console.log('title');
                break;
            case 'Sub Title':
                ////console.log('integerSub Title');
                break;
            default:
                break;
          }

          if(key === arr.length - 1){
            //console.log(BI_HTML);
            BI_HTML.forEach(element => {
                $('#BIContentDiv').append(element);
            });
            setTimeout(() => {
                relatedListenersId.forEach(element => {
                    document.querySelectorAll('input[name="'+element.related+'"]').forEach((elem) => {
                        elem.addEventListener("change", function(event) {
                          var item = event.target;
                        //   console.log('element',element,' item',item);
                          x = document.getElementById('related'+element.related);
                          if (x.style.display === "none" && item.parentElement.innerText === element.trigger_related_val ) {
                            x.style.display = "block";
                          } else {
                            x.style.display = "none";
                            var radios = x.querySelectorAll('input[type="radio"]');
                            for(var i=0;i<radios.length;i++){
                                radios[i].checked=false;
                            }
                          }
                        });
                    });
                });
            }, 800);
            
        }
    });

}

function buildCC(){
    var CCQuestions = questionsContainer.filter(obj => {
        return obj.section == 2;
      })

      CCGenQuestions = CCQuestions;

    buildCCPortraits(CCQuestions);

}

function buildCCPortraits(questions){
    let container = '';
    questions.forEach((question, key, arr) => {
        if(question.active == 1 ){

       
        let imgUrl = '';
        if(question.title == 'Drought') {
            imgUrl = 'assets/img/climateCards/d.jpg';
        } else if (question.title == 'Hurricane Ocurrencies') {
            imgUrl = 'assets/img/climateCards/hro.jpg'
        } else if (question.title == 'Heavy Raining') {
            imgUrl = 'assets/img/climateCards/hr.jpg'
        } else if (question.title == 'Flooding') {
            imgUrl = 'assets/img/climateCards/fl.jpg'
        } else if (question.title == 'Wildfires') {
            imgUrl = 'assets/img/climateCards/wf.jpg'
        } else if (question.title == 'Coastal Flooding') {
            imgUrl = 'assets/img/climateCards/cf.jpg'
        } else if (question.title == 'Drought') {
            imgUrl = 'assets/img/climateCards/d.jpg'
        }

        let pt = `<div class="col col-3 mb-5">
                    <a onClick="showCard('${'card_'+question.id}');">
                        <img class="w-100 h-100" src="${imgUrl}" />
                        <p class="text-center">${question.title}</p>
                    </a>
                </div>`;
        container += pt;

        }
        
        if(key === arr.length - 1){
            
            $('.CCImgsDiv').append(container);
            
        }
    });
}

function buildCards(){

    $('#CCContentDiv').empty();
    CCGenQuestions.forEach(element => {
        if(element.active == 1){
            // console.log('CARD:');
            // console.log(element);
            buildCard(element);
        }
    });
}

function buildCard(question){
    // console.log('BUILD CARD', question);
    let curAddress = $('#customerLocationAddress').val(),
    curLat = $('#customerLocationLat').val(),
    curLon = $('#customerLocationLon').val();

    // ////console.log(curAddress, curLat, curLon);

    let curLayer = '', curColor = '';
    // Flooding
    if(question.id == 19){
        curLayer = 'flood';
        curColor = 'Blues';
    // Wildfires
    } else if (question.id == 60) {
        curLayer = 'fire';
        curColor = 'Oranges';
    // Drought
    } else if (question.id == 62) {
        curLayer = 'drought';
        curColor = 'Set1';
    }
    // console.log('CURLAYER', curLayer);

    let pt = `<div class="shadow m-2" style="border-radius: 10px; display: none;" id="${question.title.replace(/\s/g, '')+'_container'}">
                    <div class="row">
                        <div class="col col-6">
                            <div class="embed-responsive embed-responsive-16by9" style="width: 100%; height: 600px;">
                                <iframe class="embed-responsive-item" 
                                    sandbox="allow-same-origin allow-scripts allow-popups allow-forms"
                                    src="bzmaps/bzriskmap.html?lay=${curLayer}&amp;lat=${curLat}&amp;lon=${curLon}&amp;z=12&amp;pin=1&amp;color=${curColor}"
                                ></iframe>
                            </div>
                        </div> 
                        <div class="col my-auto">
                            <div class="row mb-4">
                                <div class="col text-center">
                                    <h2 class="d-inline-flex">${question.title} Risk</h2>
                                    <input type="hidden" id="${question.title.replace(/\s/g, '')}CardInput" class="cardHiddenInput"/>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <h5 class="d-inline-flex">Address: </h5>
                                    <h6 class="d-inline-flex ml-2" id="${question.title.replace(/\s/g, '')+'_address'}">${curAddress}</h6>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <h5 class="d-inline-flex">Lat: </h5>
                                    <h6 class="d-inline-flex ml-2" id="${question.title.replace(/\s/g, '')+'_lat'}">${curLat}</h6>
                                    <h5 class="d-inline-flex ml-4">Lon: </h5>
                                    <h6 class="d-inline-flex ml-2" id="${question.title.replace(/\s/g, '')+'_lon'}">${curLon}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3 class="d-inline-flex">Score: <span id="${curLayer+'_score'}"> </span> </h3>
                                    <h6 class="d-inline-flex ml-2" id="${question.title.replace(/\s/g, '')}CardVal"></h6>
                                </div>
                            </div>
                            <hr />
                           
                        </div>
                    </div>
                </div>`;

    $('#CCContentDiv').append(pt);
}

function assignScore(type, value) {
    var score;
    
    CCGenQuestions.forEach(element => {
        // console.log('ASSIGN SCORE', type, value);
        // console.log(element);

        let riskValue = parseInt(value);
        let cleanValues = element.questions.replace(/\s/g, '');
        let riskValues = cleanValues.split("|");
        let cleanScores = element.scores.replace(/\s/g, '');
        let riskScores = cleanScores.split("|");
        let riskIndex = riskValues.indexOf(riskValue.toString());

        if(riskIndex !== -1){
            score = riskScores[riskIndex];
        } else {
            score = 0;
        }

        document.getElementById(type+'_score').innerText = score;

        
    });
}

function buildCardView(lat, lon, address, question){

    let curAddress = address,
    curLat = lat,
    curLon = lon;

    // ////console.log(curAddress, curLat, curLon);

    let curLayer = '', curColor = '';
    if(question.title == 'Flooding'){
        curLayer = 'flood';
        curColor = 'Blues';
    } else if (question.title == 'Coastal Flooding') {
        curLayer = 'costal';
        curColor = 'Purples';
    } else if (question.title == 'Wildfires') {
        curLayer = 'fire';
        curColor = 'Oranges';
    } else if (question.title == 'Drought') {
        curLayer = 'drought';
        curColor = 'Set1';
    }

    let pt = `<div class="shadow m-2" style="border-radius: 10px; display: none;" id="${question.title.replace(/\s/g, '')+'_container'}">
                    <div class="row">
                        <div class="col col-6">
                            <div class="embed-responsive embed-responsive-16by9" style="width: 100%; height: 600px;">
                                <iframe class="embed-responsive-item" 
                                    sandbox="allow-same-origin allow-scripts allow-popups allow-forms"
                                    src="bzmaps/bzriskmap.html?lay=${curLayer}&amp;lat=${curLat}&amp;lon=${curLon}&amp;z=12&amp;pin=1&amp;color=${curColor}"
                                ></iframe>
                            </div>
                        </div> 
                        <div class="col my-auto">
                            <div class="row mb-4">
                                <div class="col text-center">
                                    <h2 class="d-inline-flex">${question.title} Risk</h2>
                                    <input type="hidden" id="${question.title.replace(/\s/g, '')}CardInput" value="${question.score}" class="cardHiddenInput viewInput"/>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <h5 class="d-inline-flex">Address: </h5>
                                    <h6 class="d-inline-flex ml-2" id="${question.title.replace(/\s/g, '')+'_address'}">${curAddress}</h6>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <h5 class="d-inline-flex">Lat: </h5>
                                    <h6 class="d-inline-flex ml-2" id="${question.title.replace(/\s/g, '')+'_lat'}">${curLat}</h6>
                                    <h5 class="d-inline-flex ml-4">Lon: </h5>
                                    <h6 class="d-inline-flex ml-2" id="${question.title.replace(/\s/g, '')+'_lon'}">${curLon}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3 class="d-inline-flex">Score: ${question.score}</h3>
                                    <h6 class="d-inline-flex ml-2" style="display:none;" id="${question.title.replace(/\s/g, '')}CardVal"></h6>
                                </div>
                            </div>
                            <hr />
                            
                        </div>
                    </div>
                </div>`;

    $('#viewCCContentDiv').append(pt);
}

function showCard(id){
    // console.log(id);
    if(id == 'card_19'){
        document.getElementById("Flooding_container").style.display = 'block';
        // 
        // document.getElementById("CoastalFlooding_container").style.display = 'none';
        document.getElementById("Wildfires_container").style.display = 'none';
        document.getElementById("Drought_container").style.display = 'none';

    } else if ( id == 'card_xx'){
        document.getElementById("CoastalFlooding_container").style.display = 'block';
        // 
        document.getElementById("Flooding_container").style.display = 'none';
        document.getElementById("Wildfires_container").style.display = 'none';
        document.getElementById("Drought_container").style.display = 'none';

    } else if (id == 'card_60') {
        document.getElementById("Wildfires_container").style.display = 'block';
        // 
        document.getElementById("Flooding_container").style.display = 'none';
        // document.getElementById("CoastalFlooding_container").style.display = 'none';
        document.getElementById("Drought_container").style.display = 'none';

    } else if (id == 'card_62') {
        document.getElementById("Drought_container").style.display = 'block';
        // 
        document.getElementById("Wildfires_container").style.display = 'none';
        document.getElementById("Flooding_container").style.display = 'none';
        // document.getElementById("CoastalFlooding_container").style.display = 'none';
        
    }
}

// build CP - climate preparedness
function buildCP(viewType, sectorId){
    return new Promise(function(resolve, reject) {

        ////console.log('BUILDCP');
        ////console.log(viewType,sectorId);

        var CPQuestions, currSectorArr, divID, currSector;

        

        if(viewType == 'new'){
            divID = 'MainCPContentDiv';
        } else if(viewType == 'view'){
            divID = 'ViewCPContentDiv';
        }
    
        currSectorArr = JSON.parse(localStorage.getItem("loanSectors")).filter(obj => {
            return obj.id === sectorId
        });

        currSector = currSectorArr[0];    

        CPQuestions = questionsContainer.filter(obj => {
            return obj.section == 3;
        });

        
        // console.log('CPQUESTION');
        // console.log(CPQuestions);
        

        var CP_HTML = [];

        CPQuestionsGen = CPQuestions.filter(obj => {
            return obj.group == 1; // GENERAL
        });
        ////console.log('CPQUESTIONSGEN');
        ////console.log(CPQuestionsGen);
        
        CPQuestionsSector = CPQuestions.filter(obj => {
            return obj.group == parseInt(currSector.id)+1;
        });
        ////console.log('CPQUESTIONSSECTOR');
        ////console.log(CPQuestionsSector);

        
        ////console.log('GEN SECTOR');
        ////console.log(CPQuestionsGen);
        ////console.log(CPQuestionsSector);
        
        CP_HTML.push(`
            <div class="row my-2">
                <div class="col">
                    <h3>General</h3>
                </div>
            </div>`);

        CPQuestionsGen.forEach((question, key, arr) => {
            let type = typesContainer.filter(obj => {
                return obj.id === question.type;
            })
            
            // ////console.log(type[0].name);
            switch (type[0].name) {
                case 'Dropdown Single':
                    ////console.log('dropdown');
                    CP_HTML.push(dropDownSingle2(question));
                    break;
                case 'Text field':
                    ////console.log('text field');
                    break;
                case 'Integer':
                    ////console.log('integer');
                    break;
                case 'Number':
                    ////console.log('number');
                    break;
                case 'Checkbox group':
                    ////console.log('checkbox group');
                    CP_HTML.push(checkBox(question));
                    break;
                case 'Radio Group':
                    CP_HTML.push(radioGroup(question));
                    ////console.log('radio group');
                    break;
                case 'Climate Risk Card':
                    ////console.log('climate risk card');
                    break;
                case 'Dropdown multiple':
                    ////console.log('drop down mul');
                    CP_HTML.push(dropdownSingle2(question));
                    break;
                default:
                    break;
            }

            if(key === arr.length - 1){
                
                // INSERT THE REST
                CPQuestionsSector.forEach((question, key, arr) => {
                    let type = typesContainer.filter(obj => {
                        return obj.id === question.type;
                    })
            
                    if(key == 0){
                        CP_HTML.push(`
                        <div class="row mt-4 mb-3">
                            <div class="col">
                                <h3>${currSector.name}</h3>
                            </div>
                        </div>`);
                    }
                    
                    switch (type[0].name) {
                        case 'Dropdown Single':
                            ////console.log('dropdown');
                            CP_HTML.push(dropDownSingle2(question));
                            break;
                        case 'Text field':
                            ////console.log('text field');
                            break;
                        case 'Integer':
                            ////console.log('integer');
                            break;
                        case 'Number':
                            ////console.log('number');
                            break;
                        case 'Checkbox group':
                            ////console.log('checkbox group');
                            CP_HTML.push(checkBox(question));
                            break;
                        case 'Radio Group':
                            CP_HTML.push(radioGroup(question));
                            ////console.log('radio group');
                            break;
                        case 'Climate Risk Card':
                            ////console.log('climate risk card');
                            break;
                        case 'Dropdown multiple':
                            ////console.log('drop down mul');
                            CP_HTML.push(dropdownSingle2(question));
                            break;
                        case 'Geolocation':
                            ////console.log('geo');
                            break;
                        case 'Range selector slider':
                            ////console.log('sel slider');
                            break;
                        case 'Range Selector Radio':
                            ////console.log('range sel');
                            break;
                        case 'Date Range':
                            ////console.log('date range');
                            break;
                        case 'Date Selector':
                            ////console.log('date sel');
                            break;
                        case 'Title':
                            ////console.log('title');
                            break;
                        case 'Sub Title':
                            ////console.log('integerSub Title');
                            break;
                        default:
                            break;
                    }
            
                    if(key === arr.length - 1){
                        ////console.log(CP_HTML);
                        ////console.log('#'+divID);
                        CP_HTML.forEach((element, index, array) => {
                            $('#'+divID).append(element);
                            if(index == array.length-1){
                                resolve(true);
                            }
                        });
                    
                    }
                });

            }

        });

    });
    
}

// input types
function dropdownSingle(containerID,title, options) {
    ////console.log('dropdown');
    ////console.log(options);
    $('#'+containerID).append($('<option>', {
        value: 'null',
        text: 'Select an option'
    }));
    options.forEach(element => {
        $('#'+containerID).append($('<option>', {
            value: element.id,
            text: element.title,
        }));
    });

}


function dropDownSingle2(question) {

    let inner = '';
    let pt1 = `<div class="col">
                <p class="input-label mb-2">${question.placeholder}</p>
                <select class="form-control" id=${question.id}>
                    <optgroup label="This is a group">`;

    let scores = question.scores.split('|')
    let questions = question.questions.split('|')

    questions.forEach((element, key, arr)  => {
        inner += `<option value="${scores[key].replace(/\s/g, '')}">${element}</option>`;
    });

    let pt2 = `</optgroup>
                </select>
            </div>`;

    return pt1+inner+pt2; 
}

function radioGroup(question) {
    let inner = '';
    let pt1 = `<div class="row">
                    <div class="col col-7">
                        <p class="input-label mb-2">${question.placeholder}</p>
                `;

    let scores = question.scores.split('|')
    let questions = question.questions.split('|')

    questions.forEach((element, key, arr)  => {
        inner += `<div class="form-check d-inline-flex ml-3">
                        <input type="radio" class="form-check-input" id="${question.title.replace(/\s/g, '')+key}" value="${scores[key].replace(/\s/g, '')}" name="${question.id}" />
                        <label class="form-check-label" for="${question.title.replace(/\s/g, '')+key}">${element}</label>
                    </div>`;
        
        if(key == arr.length-1){
            if(question.has_recommendations == 1){
                inner+= 
                `   </div>
                        <div class="col col-5">
                            <p class="mt-3">Remarks</p>
                            <textarea class="ml-4 mt-1 recommendations" cols="40" id="${question.id}"></textarea>
                        </div>
                    </div>              
                `
            } else {
                inner+= 
                `       </div>
                    </div>                  
                `
            }
        }

    });
    
    return pt1+inner; 
}

function checkBox(question) {
    //console.log('CHECKBOX',question);
    let inner = '';
    let pt1 = `<div class="col" id="${question.related ? 'related'+question.related : 'notRelated'+question.id}" style="${question.related ? 'display: none' : ''}">
                <p class="input-label mb-2" >
                    ${question.placeholder}
                </p>
                `;

    let scores = question.scores.split('|')
    let questions = question.questions.split('|')

    questions.forEach((element, key, arr)  => {
        inner += `<div class="form-check d-inline-flex ml-3">
                        <input type="radio" class="form-check-input" id="${question.title.replace(/\s/g, '')+key}" value="${scores[key].replace(/\s/g, '')}" name="${question.id}" />
                        <label class="form-check-label" for="${question.title.replace(/\s/g, '')+key}">${element}</label>
                    </div>`;
    });

    let pt2 = `</div>`;

    return pt1+inner+pt2; 
}