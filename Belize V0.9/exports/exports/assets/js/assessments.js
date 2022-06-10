function viewAssessment(id, action){
  if(action == 'view'){
    window.location.href = '/viewAssessment.html?assessment_id='+id+'&action=view';
  } else if (action == 'edit') {
    window.location.href = '/viewAssessment.html?assessment_id='+id+'&action=edit';
  } else if (action == 'delete') {
    $('#confirmDeleteModal').modal('show');
    $('#confirmDeleteAssessmentBtn').attr('assessment_id', id);
  }
  
}

$( "#confirmDeleteAssessmentBtn" ).click(function() {
    editAssessment($(this).attr('assessment_id'));
});

// EDIT ASSESSMENT
function editAssessment(id){
  $('#assessmentsReportTableBody').empty();
  var settings = {
    url: apiURL + '',
    type: "POST",
    data: {
        action: 'edit',
        object: 'assessments',
        id: id,
        status: 2
    },
    "headers": {
      "Authorization": "Bearer "+gToken
    },
  };

    $.ajax(settings).done(function (response) {
        // console.log(response);
        location.reload();
    });
}

// --------------------------------------------------
// -------------------- REPORT ----------------------
// --------------------------------------------------

function getAssessmentsReport(){
    $('#assessmentsReportTableBody').empty();
    var settings = {
        "url": apiURL+"?action=list&object=view1",
        "method": "GET",
        "timeout": 0,
        "headers": {
          "Authorization": "Bearer "+gToken
        },
      };

    //   ////console.log(settings);
      
      $.ajax(settings).done(function (response) {
        
        response.view1.forEach((element, key, arr) => {
            
            // ////console.log(element);
            let tableRow = `
                <tr>
                    <td>${element.assessment_id}</td>
                    <td>${element.customer_id ? element.customer_id : ''}</td>
                    <td>${element.customer_first_name}</td>
                    <td>${element.loan_purpose_name}</td>
                    <td>${element.loan_section_name}</td>
                    <td>${element.total_score ? element.total_score : '' }</td>
                    <td>
                      ${
                        element.status == 0 ? 'New' : 
                        element.status == 1 ? 'Completed' :
                        element.status == 2 ? 'Deleted' : 'Err' 
                      }
                    </td>
                    <td>
                      ${ new Date(element.updated_at).toLocaleDateString('en-EN', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) }
                     - ${ new Date(element.updated_at).toLocaleTimeString('en-EN', { hour: 'numeric', minute: 'numeric', hour12: true }) }

                    </td>
                    <td></td>
                </tr>
            `;
            $('#assessmentsReportTableBody').append(tableRow);
            if(key === arr.length - 1){
                var table = $('#assessmentsReportTable').DataTable(
                  {
                    dom: 'Bfrtip',
                    buttons: [
                        'csv', 'excel', 'pdf'
                    ],
                    order: [[ 0, "desc" ]],
                    columnDefs: [{
                       targets: 8,
                       render: function(data, type, row, meta){
                          if(type === 'display'){
                             data = data +
                                `<div class="links">
                                  ${row[6] == 'Deleted' ? '' : 
                                  `<a class="viewAssessmentAction mr-3 text-primary" onclick="viewAssessment(${row[0]}, \'view\')" ><i class="fas fa-eye"></i></a>`}
                                  ${row[6] == 'Deleted' ? '' : 
                                  '<a class="viewAssessmentAction text-danger" onclick="viewAssessment('+row[0]+', \'delete\')" ><i class="fas fa-trash"></i></a>'} 
                                </div>`;                     
                          }
                          return data;
                       }
                    }]
                }
                );
            }
        });

      });
}

function getAssessmentQuestionsAnswers(assessment_id){
  $('#assessmentsReportTableBody').empty();
  var settings = {
    "url": toolsURL+"_report.php?id="+assessment_id,
    "method": "GET",
    "timeout": 0,
    "headers": {
      "Authorization": "Bearer "+gToken
    },
  };

  // console.log(settings);
    
  $.ajax(settings).done(function (response) {
    //console.log(response);
    
    if(response){
      
      setTimeout(() => {
        $('.viewAssessmentTabs').show();
        $('#viewCarousel').carousel(5);
        buildCP('view', response.assessment[0].loan_section).then(r =>{
          //console.log('Llego')
          buildView(response).then(r =>{
            buildReport(assessment_id, 'view');
          }).catch((e) => {
            console.log('error', e);
          });
        }).catch((e) => {
          console.log('error',e);
        });
      }, 1500);
    }
    

  }).fail(function() {
    alert( "error" );
  });
}

// GENERATE REPORT

function buildReport(assessment_id, type){
  var recommendationsContainer, SSContainer, SContainer, 
    floodingMap, wildfiresMap, droughtMap,
    floodingRes, wildfiresRes, droughtRes,
    customerName, customerIDCol, customerID,
    customerSex, customerAge, customerAddress,
    customerLat, customerLon, customerLoanP, 
    customerLoanS;

  if(type == 'view'){
    recommendationsContainer = 'viewReportRecommendations', commentsContainer = 'viewReportComments', SSContainer = 'viewReportScores',
    // 
    floodingMap = 'viewFloodingReport', wildfiresMap = 'viewWildfiresReport', droughtMap = 'viewDroughtReport',
    // 
    floodingRes = 'viewFloodingResult', wildfiresRes = 'viewWildfiresResult', droughtRes = 'viewDroughtResult',
    // 
    SContainer = 'viewReportScore',

    // customer data
    customerName = 'viewReportCustomerName', customerIDCol = 'viewReportCustomerIDCol', customerID = 'viewReportCustomerID',
    customerSex = 'viewReportCustomerSex', customerAge = 'viewReportCustomerAge', customerAddress = 'viewReportCustomerAddress',
    customerLat = 'viewReportCustomerLat', customerLon = 'viewReportCustomerLon', customerLoanP = 'viewReportCustomerLoanP', 
    customerLoanS = 'viewReportCustomerLoanS';

  } else if (type == 'new'){
    recommendationsContainer = 'reportRecommendations', commentsContainer = 'reportComments', SSContainer = 'reportScores',
    // 
    floodingMap = 'floodingReport', wildfiresMap = 'wildfiresReport', droughtMap = 'droughtReport',
    // 
    floodingRes = 'floodingResult', wildfiresRes = 'wildfiresResult', droughtRes = 'droughtResult',
    // 
    SContainer = 'reportScore',

    // customer data
    customerName = 'reportCustomerName', customerIDCol = 'reportCustomerIDCol', customerID = 'reportCustomerID',
    customerSex = 'reportCustomerSex', customerAge = 'reportCustomerAge', customerAddress = 'reportCustomerAddress',
    customerLat = 'reportCustomerLat', customerLon = 'reportCustomerLon', customerLoanP = 'reportCustomerLoanP', 
    customerLoanS = 'reportCustomerLoanS';
    


  }
  $('#'+recommendationsContainer).empty();
  $('#'+commentsContainer).empty();
  $('#'+SSContainer).empty();

  var settings = {
    "url": toolsURL+"_report.php?id="+assessment_id,
    "method": "GET",
    "timeout": 0,
    "headers": {
      "Authorization": "Bearer "+gToken
    },
  };

  var recommendationsHTML = '', SSHTML = '', commentsHTML = '';
    
  $.ajax(settings).done(function (response) {

    //console.log(response);
    
    if(response){
      // SCORE
      // $('#'+SContainer).text(response.assessment[0].total_score);

      var Ggrade = parseFloat(response.assessment[0].total_score)/parseFloat(response.scores.score_max);

      // calculating score
      // high > 66
      // medium > 33
      // low < 33
      //console.log('grade',Ggrade);
      let GgradeTxt = Ggrade >= 0.66 ? 'High' :  0.66 > Ggrade >= 0.33 ? 'Medium' : 0.33 > Ggrade ? 'Low' : 'Nan';
      let GgradeColor = Ggrade >= 0.66 ? 'danger' :  0.66 > Ggrade >= 0.33 ? 'warning' : 0.33 > Ggrade ? 'success' : 'Nan';
      $('#'+SContainer).text(GgradeTxt);
      $('#'+SContainer).parent().css( "background", `var(--${GgradeColor})` );


      // RECOMMENDATIONS
      if(response.recommendations_by_score){
        response.recommendations_by_score.forEach((element, index, array) => {

          recommendationsHTML += `
          <div class="row mt-1">
            <div class="col">
                <p>${element.question_id}) <strong> ${element.placeholder} </strong></p>
                <p class="ml-3">${element.recommendation_by_score}</p>
            </div>
        </div>
        `
        if(index == array.length-1){
          $('#'+recommendationsContainer).append(recommendationsHTML);
        }
      });
      }

      // Comments
      if(response.remarks){
        response.remarks.forEach((element, index, array) => {

            commentsHTML += `
            <div class="row mt-1">
              <div class="col">
                  <p>${element.question_id}) <strong> ${element.placeholder} </strong></p>
                  <p class="ml-3">${element.recommendations}</p>
              </div>
          </div>
          `
          if(index == array.length-1){
            $('#'+commentsContainer).append(commentsHTML);
          }
        });
      }

      // SCORES 
      response.section_scores.forEach((element, index, array) => {

        var grade = parseFloat(element.section_score)/parseFloat(response.scores[`max${[index+1]}`]);

        // calculating score
        // high > 66
        // medium > 33
        // low < 33
        //console.log('grade',grade);
        let gradeTxt = grade >= 0.66 ? 'High' :  0.66 > grade >= 0.33 ? 'Medium' : 0.33 > grade ? 'Low' : 'Nan';
        let gradeColor = grade >= 0.66 ? 'danger' :  0.66 > grade >= 0.33 ? 'warning' : 0.33 > grade ? 'success' : 'Nan';

        SSHTML += `
          <div class="row">
              <div class="col text-right d-inline-block float-left d-lg-flex justify-content-lg-end align-items-lg-end">
                  <h5 class="text-right justify-content-end mt-1">${element.title}</h5>
              </div>
              <div class="col d-lg-flex justify-content-lg-center col-4">
                  <div class="d-lg-flex justify-content-lg-center align-items-lg-center shadow pt-2" style="height: 30px;width: 100px;color: white;border-radius: 20px; background: var(--${gradeColor});">
                      <h5>${gradeTxt}</h5>
                  </div><a class="ml-2" href="#" data-toggle="tooltip" data-placement="top" title="${element.desc} " style="font-size: 20px;">i</a>
              </div>
          </div>
        `
        if(index == array.length-1){
          $('#'+SSContainer).append(SSHTML);
        }
      });

     

      // RISK MAPS
      $('#'+floodingMap).attr('src', `bzmaps/bzriskmap.html?lay=flood&lat=${response.assessment[0].lat}&lon=${response.assessment[0].lon}&z=12&pin=1&color=Blues`);
      $('#'+wildfiresMap).attr('src', `bzmaps/bzriskmap.html?lay=fire&lat=${response.assessment[0].lat}&lon=${response.assessment[0].lon}&z=12&pin=1&color=Oranges`);
      $('#'+droughtMap).attr('src', `bzmaps/bzriskmap.html?lay=drought&lat=${response.assessment[0].lat}&lon=${response.assessment[0].lon}&z=12&pin=1&color=Set1`);

      // CUSTOMER DATA
      $('#'+customerName).text(response.assessment[0].customer_first_name);
      // setting page title 
      document.title = 'riskAssessmentTool-'+response.assessment[0].customer_first_name.replace(/ /g,"_")+'-'+assessment_id;

      if(response.assessment[0].customer_id.lenght > 3){
        $('#'+customerID).text(response.assessment[0].customer_id);
        $('#'+customerIDCol).show();
      } else {
        $('#'+customerIDCol).hide();
      }
      $('#'+customerAge).text(response.assessment[0].customer_age);
      $('#'+customerSex).text(response.assessment[0].sex);
      $('#'+customerAddress).text(response.assessment[0].address);
      $('#'+customerLat).text(response.assessment[0].lat);
      $('#'+customerLon).text(response.assessment[0].lon);
      $('#'+customerLoanP).text(response.loan_purpose[0].name);
      $('#'+customerLoanS).text(response.loan_section[0].name);

      var topMessage = `Assessment ID: ${response.assessment[0].id} Score: ${response.assessment[0].total_score} 
      Customer name: ${response.assessment[0].customer_first_name} ${response.assessment[0].customer_id ? 'Customer ID: '+response.assessment[0].customer_id: ''} 
      Loan Purpose: ${response.loan_purpose[0].name}. Loan Sector: ${response.loan_section[0].name} 
      Date: ${ new Date(response.assessment[0].updated_at).toLocaleDateString('en-EN', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) } - ${ new Date(response.assessment[0].updated_at).toLocaleTimeString('en-EN', { hour: 'numeric', minute: 'numeric', hour12: true }) }
      `;
      // REPORT TABLES IF view assessment 
      $('#viewAssessmentReportTableBody').empty();
      
      if (type == 'view'){
        response.answers.forEach((element, key, arr) => {
            
          // ////console.log(element);
          let tableRow = `
              <tr>
                  <td>${element.question_id}</td>
                  <td>${element.assessment_id}</td>
                  <td>${element.title}</td>
                  <td>${element.placeholder}</td>
                  <td>${element.response}</td>
                  <td>${element.score}</td>
              </tr>
          `;
          $('#viewAssessmentReportTableBody').append(tableRow);
          if(key === arr.length - 1){
              try {
                $('#viewAssessmentReportTable').DataTable(
                  {
                    pageLength: 50,
                    dom: 'Bfrtip',
                    buttons: [
                      {
                          extend: 'csv',
                          messageTop: topMessage
                      },
                      {
                        extend: 'excel',
                        messageTop: topMessage
                      },
                      {
                            extend: 'pdf',
                            messageTop: topMessage
                      },
                    ],
                    order: [[ 0, "asc" ]]
                  }
                );
              } catch (error) {
                console.error(error);
              }
              }
          });
      } 

     
    }
    

  }).fail(function() {
    alert( "error" );
  });
}

function reportRisk(data, type){
  //console.log('RISK REPORT');
  var scoreContainerID = type+'RiskScore_'+data.lay,
  containerID = type+'RiskContainer_'+data.lay,
  scoreTxt = '', scoreColor = '';
  
  if(data.lay == 'drought'){
    
    var low = [ 0, 1],
    medium = [2,3],
    high = [4];
    
    if( low.includes(data.val[0]) ){
      
      scoreTxt = 'Low: '+data.val[0];
      scoreColor  = '#1dc98b';
      
    } else if ( medium.includes(data.val[0]) ) {

      scoreTxt = 'Medium: '+data.val[0];
      scoreColor  = '#f5c13e';

    } else if ( high.includes(data.val[0]) ) {

      scoreTxt = 'High: '+data.val[0];
      scoreColor  = '#e84d3e';

    }

  } else if (data.lay == 'fire') {

    var low = [ 0, 1, 2, 3, 4, 5, 6],
    medium = [7, 8, 9, 10, 11, 12],
    high = [13, 14, 15, 16, 17];
    
    if( low.includes(data.val[0]) ){
      
      scoreTxt = 'Low: '+data.val[0];
      scoreColor  = '#1dc98b';
      
    } else if ( medium.includes(data.val[0]) ) {

      scoreTxt = 'Medium: '+data.val[0];
      scoreColor  = '#f5c13e';

    } else if ( high.includes(data.val[0]) ) {

      scoreTxt = 'High: '+data.val[0];
      scoreColor  = '#e84d3e';

    }

  } else if (data.lay == 'flood') {

    var low = [0, 1, 2],
    medium = [3, 4, 5],
    high = [6, 7];
    
    if( low.includes(data.val[0]) ){
      
      scoreTxt = 'Low: '+data.val[0];
      scoreColor  = '#1dc98b';

    } else if ( medium.includes(data.val[0]) ) {

      scoreTxt = 'Medium: '+data.val[0];
      scoreColor  = '#f5c13e';
      
    } else if ( high.includes(data.val[0]) ) {

      scoreTxt = 'High: '+data.val[0];
      scoreColor  = '#e84d3e';

    }

  }
  $('#'+scoreContainerID).text(scoreTxt);
  $('#'+containerID).css('background-color', scoreColor);

}

// print report

$( "#printReportBtn" ).click(function() {
  
  if(window.location.pathname == '/viewAssessment.html'){
    printReport('viewClimateRiskReport');
  } else if (window.location.pathname == '/home.html') {
    printReport('climateRiskReport');
  } 
});

function printReport(divId){
  $('#'+divId).printThis(
    {
      loadCSS: "style.css",
      importStyle: true,         // import style tags

    }
  );

  // var divToPrint=document.getElementById(divId);

  // var newWin=window.open('','Print-Window');

  // newWin.document.open();

  // newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  // newWin.document.close();

  // setTimeout(function(){newWin.close();},10);
  // window.print();

}