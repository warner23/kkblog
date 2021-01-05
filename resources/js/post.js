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

post.thumbsUp = function(id){

    $.ajax({
        url: "app/core/class/Ajax.php",
        type: "POST",
        dataType: "json",
        data: {
            action  : "thumbup",
            id      : id
        },
        success: function (result) {
            if(result.status == "success"){
                
                if(result.tustatus == "true"){
                    $("#tus").attr("src", result.src);
                }else{
                     $("#tus").attr("src", result.src);
                }
                
            }else {
                window.location = "index.php";
            }
        }
    });

}

post.thumbsDown = function(id){
    
    $.ajax({
        url: "app/core/class/Ajax.php",
        type: "POST",
        dataType: "json",
        data: {
            action  : "thumbdown",
            id      : id
        },
        success: function (result) {
             //console.log(result );
            if(result.status == "success"){
                //console.log(result.tdstatus );
                if(result.tdstatus == "true"){
                     $("#tds").attr("src", result.src);
                }else{
                     $("#tds").attr("src", result.src);
                }
                
            }
        }
    });

}