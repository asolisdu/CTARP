// getting local storage
var gToken = '', gEmail = '', gUser = {};
gEmail = localStorage.getItem("email");
gToken = localStorage.getItem("token");
gUser = JSON.parse(localStorage.getItem('user')); 


$(document).ready(function () {

	//console.log(window.location);
	//console.log('token: '+gToken);
	
	if(window.location.pathname !== '/index.html' && gToken == null ){
		window.location.href = '/index.html';
	} else if(gUser.userid && gToken){
		getProfile(gUser.userid);
	}   
	


});

// listeners
$('#loginBtn').click(function () {
    let email = $('#emailInput').val();
    let pass = $('#passInput').val();

    login(email, pass);
});

$('#logoutBtn').click(function () {
	logOut();
});


// ------------------------------------------------------------

// functions
function login(email, pass){
	//console.log('logging in');

	var data = "action=login&username=" + email + "&password=" + pass;

    $.post(apiURL, data, function (data) {

		window.location.href = '/home.html';

		// console.log('success LOGIN');
		// console.log(data);
		
		token = data.JWT;
		localStorage.setItem("token", token);
		localStorage.setItem("email", email);
		localStorage.setItem("user", JSON.stringify(data));
		gToken = token;
		gEmail = email;
		gUser = JSON.parse(data);
		// if logged in getProfile 
		getProfile(gUser.userid);
	
	}).fail(function (xhr, status, error) {

		token = ''; //not logged in token = none
		localStorage.setItem('token', token);
		alert("Login Failed ");

	});

}

function getProfile(id){
    var url = apiURL + "?action=view&object=users&id=" + id;
    $.ajax({
		url: url,
		type: "GET",
		success: function (data, status, xhr) {

			//console.log('ALERT:');
			//console.log(data);
			buildForm();
			$('#userProfileID').text(data.users.id);
			$('#userProfileFNames').text(data.users.first_names);
			$('#userProfileLNames').text(data.users.last_names);
			$('#userProfileEmail').text(data.users.email);
			$('#userNameWelcome').text('Hello, '+data.users.first_names+' '+data.users.last_names);
			$('#helloUserSpan').text('Hello, '+data.users.first_names+' '+data.users.last_names);
			$('#userNameWelcomeDiv').show();

        },
		error: function (xhr, ajaxOptions, thrownError) {
			//console.log('Error');
			if(window.location.pathname !== '/index.html' ){
				window.location.href = '/index.html';
			} 
        },
		beforeSend: function (request) { // Set JWT header
			request.setRequestHeader('Authorization', 'Bearer ' + gToken);
        }
    });
}

function logOut(){
	localStorage.clear();
	window.location.href = '/index.html';
}