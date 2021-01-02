 $(document).ready(function () {
 	//catch form submit
 	$(".form-horizontal").submit(function () {
    	return false;
    });
 	

    //button login click
    $("#login-btn").click(function () {
        var  un    = $("#username"),
             pa    = $("#password");

       //validate login form
       if(login.validateLogin(un, pa) === true) { 
           //validation passed, prepare data that will be sent to server
            var data = {
                username: un.val(),
                password: pa.val(),
                id: {
                    username: "username",
                    password: "password"
                }
            };
            
            //send login data to server
            login.loginUser(data);
       }

    });


    //set focus on username field when page is loaded
    $("#username").focus();
});


/** LOGIN NAMESPACE
 ======================================== */
var login = {};

login.loginUser = function (data) {
    var btn = $("#login-btn");
    core.loadingButton(btn, "Logging in...");

    //encrypt password before sending it through the network
    data.password = CryptoJS.SHA512(data.password).toString();

    $.ajax({
        url: "app/core/class/Ajax.php",
        type: "POST",
        dataType: "json",
        data: {
            action  : "checkLogin",
            username: data.username,
            password: data.password,
            id      : data.id
        },
        success: function (result) {
           core.removeLoadingButton(btn);
           if( result.status === 'success' )
               window.location = result.page;
           else {
               core.displayErrorMessage($("#username"));
               core.displayErrorMessage($("#password"), result.message);
           }

        }
    });
};

login.validateLogin = function (un, pass) {
    var valid = true;

    //remove previous error messages
    core.removeErrorMessages();

    if($.trim(un.val()) == "") {
        core.displayErrorMessage(un);
        valid = false;
    }
    if($.trim(pass.val()) == "") {
        core.displayErrorMessage(pass);
        valid = false;
    }

    return valid;
};