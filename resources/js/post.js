 $(document).ready(function () {

});


/** LOGIN NAMESPACE
======================================== */
var post = {}; 


post.single = function (id) {



    $.ajax({
        url: "app/core/class/Ajax.php",
        type: "POST",
        dataType: "json",
        data: {
            action  : "postId",
            id      : id
        },
        success: function (result) {
            if(result == "success"){
                window.location ="single.php";
            }
        }
    });
};

