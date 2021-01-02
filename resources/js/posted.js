 $(document).ready(function () {

    posted.load();
});

/** LOGIN NAMESPACE
======================================== */
var posted = {}; 

posted.load = function(){
    
    $.ajax({
        url: "app/core/class/Ajax.php",
        type: "POST",
        dataType: "json",
        data: {
            action  : "postload"
        },
        success : function (result) {
            console.log(result);
            if(result.status == "success"){
                $("#loadPage").html(result.div);
            }
            
        }
    });
}