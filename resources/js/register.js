$(document).ready(function () {
    //button register click
    $(".form-horizontal").submit(function () {
        return false;
    });

    $("#register-btn").click(function () {
        if(register.validateRegistration() === true) {
            //validation passed
            var regMail     = $("#email").val(),
                regUser     = $("#username").val(),
                regPass     = $("#password").val(),
                regPassConf = $("#passwordConf").val();


            //create data that will be sent to server
            var data = { 
                UserData: {
                    email           : regMail,
                    username        : regUser,
                    password        : regPass,
                    confirm_password: regPassConf
                },
                FieldId: {
                    email           : "email",
                    username        : "username",
                    password        : "password",
                    confirm_password: "passwordConf"
                }
            };
            //send data to server
            register.registerUser(data);
        }                        
    });
});



/** REGISTER NAMESPACE
 ======================================== */

var register = {};


/**
 * Registers new user.
 * @param {Object} data Register form data.
 */
register.registerUser = function (data) {
    //get register button
    var btn = $("#register-btn");
    
    //put button to loading state
    core.loadingButton(btn, "Creating Account");
    
    //hash passwords before send them through network
    data.UserData.password = CryptoJS.SHA512(data.UserData.password).toString();
    data.UserData.confirm_password = CryptoJS.SHA512(data.UserData.confirm_password).toString();
    
    //send data to server
    $.ajax({
        url: "app/core/class/Ajax.php",
        type: "POST",
        data: {
            action  : "registerUser",
            user    : data
        },
        success: function (result) {
            //return button to normal state
            core.removeLoadingButton(btn);

            console.log(result);
            
            //parse result to JSON
            var res = JSON.parse(result);
            
            if(res.status === "error") {
                //error
                
                //display all errors
                for(var i=0; i<res.errors.length; i++) {
                    var error = res.errors[i];
                    core.displayErrorMessage($("#"+error.id), error.msg);
                }
            }
            else {
                //display success message
                core.displaySuccessMessage($("#result"), res.msg);
             //  $( "#msg").html(+res.msg+)

            }
        }
    });
};


/**
 * Validate registration form.
 * @returns {Boolean} TRUE if form is valid, FALSE otherwise.
 */
register.validateRegistration = function () {
    var valid = true;
    
    //remove previous error messages
    core.removeErrorMessages();
    

    //check if all fields are filled
    $(".form-horizontal").find("input").each(function () {
        var el = $(this);

        if($.trim(el.val()) === "") {
            core.displayErrorMessage(el);
            valid = false;
        }
    });

    //get email, password and confirm password for further validation
    var regMail     = $("#email"),
        regPass     = $("#password"),
        regPassConf = $("#passwordConf");
        
    //check if email is valid
    if(!core.validateEmail(regMail.val()) && regMail.val() != "") {
        valid = false;
        core.displayErrorMessage(regMail,"Email wrong format");
    }

    //check if password and confirm password fields are equal
    if(regPass.val() !== regPassConf.val() && regPass.val() != "" && regPassConf.val() != "") {
        valid = false;
        core.displayErrorMessage(regPassConf, "password does not match");
    }

    //check password length
    if($.trim(regPass.val()).length <= 5) {
        valid = false;
        core.displayErrorMessage(regPass, "password too small");
    }
    return valid;
};