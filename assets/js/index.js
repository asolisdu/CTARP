// global variables para local
// const apiURL = location.origin+'/admin/api/';
// const toolsURL = location.origin+'/admin/_tools/';

const apiURL =   'https://risks.on.gt/admin/api/';
const toolsURL = 'https://risks.on.gt/admin/_tools/';
        
        


var sectionData = [];
var sectionLabels = [];
var regionData = [];
var regionLabels = [];
//const apiURL =   'https://a56daec0.us-south.apigw.appdomain.cloud/tarp/admin/api/';
// const toolsURL = 'https://a56daec0.us-south.apigw.appdomain.cloud/tarp/admin/_tools/';

//const apiURL =   'http://192.168.39.104/admin/api/';
//const toolsURL = 'http://192.168.39.104/admin/_tools/';

var risk = [0,0,0,0]
var months = {
    0: [],
    1: [],
    2: [],
    3: [],
    4: [],
    5: [],
    6: [],
    7: [],
    8: [],
    9: [],
    10: [],
    11: [],
}
var geojson = {};
geojson['type'] = 'FeatureCollection';
geojson['features'] = [];

function assessmentData() {
  var settings = {
      "async": false,
      "url": apiURL+"?action=list&object=view1",
          "method": "GET",
          "timeout": 0,
          "headers": {
            "Authorization": "Bearer "+gToken
      }
    };
    $.ajax(settings).done(function (response) {
      response.view1.forEach((element, key, arr) => {

        if (sectionLabels.includes(element.loan_section_name)) {
            sectionData[sectionLabels.indexOf(element.loan_section_name)]++;
        } else {
            sectionLabels.push(element.loan_section_name);
            sectionData.push(0)
            sectionData[sectionLabels.indexOf(element.loan_section_name)]++
        }

        if (regionLabels.includes(element.region_name)) {
            regionData[regionLabels.indexOf(element.region_name)]++;
        } else {
            regionLabels.push(element.region_name);
            regionData.push(0)
            regionData[regionLabels.indexOf(element.region_name)]++
        }

        if (parseInt(element.score_ratio) <= 0.6) {
            risk[2]++;
        } else if (parseInt(element.score_ratio) > 6 && parseInt(element.score_ratio) < 0.8) {
            risk[1]++;
        } else if (parseInt(element.score_ratio) >= 0.8) {
            risk[0]++;
        } else {
            risk[3]++;
        }
        var tempDate = new Date(element.created_at);
        months[tempDate.getMonth()].push(element)

        var newFeature = {
            "type": "Feature",
            "geometry": {
            "type": "Point",
            "coordinates": [parseFloat(element.lon), parseFloat(element.lat)]
            },
            "properties": element
        }; 
        geojson['features'].push(newFeature);
        
      });
    })
    ;}
    if(window.location.pathname == '/home.html'){
        assessmentData();
        getAssessmentsReportIndex();
    }


$(document).ready(function() {   
    applyThemeConfig(); 
    
    getQuestionTypes();
    // getLoanP();
    // getLoanS();
    getSections();

    $('#example').DataTable( {
        ajax:           "./assets/data.txt",
        deferRender:    true,
        scrollY:        500,
        scrollCollapse: true,
        scroller:       true
    } );

    

    

    if(window.location.pathname == '/assessmentsReport.html'){
        getAssessmentsReport();
    } else if (window.location.pathname == '/home_new.html') {
        console.log('window.location.pathname',window.location.pathname);
        $("#startAssessmentBtn").trigger('click');
    } else if (window.location.pathname == '/viewAssessment.html') {
        var assessment_id = getUrlParameter('assessment_id');
        var action = getUrlParameter('action');
        getAssessmentQuestionsAnswers(assessment_id);
        applyInputClass(action);
    }

});

function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};


function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


function round(value, precision) {
    var multiplier = Math.pow(10, precision || 0);
    return Math.round(value * multiplier) / multiplier;
}

function onEachFeature(feature, layer) {
    var popupContent = "";

    if (feature.properties && feature.properties.assessment_id) {
        popupContent += '<b>Assessment Id No. </b><a href="/viewAssessment.html?assessment_id='+feature.properties.assessment_id+'&action=view">'+feature.properties.assessment_id+'</a><br><hr>';
        popupContent += '<b>Name: </b>'+feature.properties.customer_first_name+'<br>';
        popupContent += '<b>Loan Purpose: </b>'+feature.properties.loan_purpose_name+'<br>';
        popupContent += '<b>Loan Sector: </b>'+feature.properties.loan_section_name+'<br>';
        popupContent += '<b>Date: </b>'+feature.properties.created_at+'<br>';
    }

    layer.bindPopup(popupContent);
}

function plot(data){
    console.log(geojson)
    capa = L.geoJSON(data, {
    style: function(feature) {
        if (parseInt(feature.properties.score_ratio, 10) <= 0.6){
            return {color: "red"}
        } else if (parseInt(feature.properties.score_ratio, 10) > 0.6 && parseInt(feature.properties.score_ratio, 10) <= 0.8) {
            return {color: "yellow"}
        } else if (parseInt(feature.properties.score_ratio, 10) > 0.8) {
            return {color: "green"}
        } else {
            return {color: "white"}
        }
    },
    onEachFeature: onEachFeature,
    pointToLayer: function(feature, latlng) {
    return L.circleMarker(latlng, {
    radius: 4,
    weight: 2,
    opacity: 1,
    fillOpacity: 0.8
        });
    }
    }).addTo(map);
} //plot


    
