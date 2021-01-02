$(document).ready(function () {
    

	
});

comment = {};

comment.newCommment = function(id){

var comment = $("#comment-text-"+id),
             btn    = $("#btn-comment-"+id);

        //validate comment
        if($.trim(comment.val()) == "") {
            core.displayErrorMessage(comment, "Field required.");
            return;
        }

        //set button to posting state
        core.loadingButton(btn, "Posting...");
        
         $.ajax({
            url: "app/core/class/Ajax.php",
            type: "POST",
            data: {
                action : "postComment",
                id : id,
                comment: comment.val()
            },
            success: function (response) {
                //return button to normal state
                core.removeLoadingButton(btn);
                   //try to parse result to JSON
                   var res = JSON.parse(response);
                   
                   console.log(res);
                   //generate comment html and display it
                   var html  = "<blockquote>";
                        html += "<p>"+res.comment+"</p>";
                        html += "<small>"+res.user+" <em> "+res.postTime+"</em></small>";
                        html += "</blockquote>";
                   console.log($(".comments-comments blockquote").length);
                    if( $(".comments-comments blockquote").length >= 7 ){
                      console.log($(html));
                      $(".comments-comments blockquote").last().remove();

                    $(".comments-comments").prepend($(html));
                    comment.val("");
                  }else{
                     console.log($(html));
                    $(".comments-comments").prepend($(html));
                    comment.val("");
                  }
                    
                }
        });
}