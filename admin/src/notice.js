jQuery(document).ready(function($){
   $(document).on('click','.notice-dismiss',function(){
        let id = $(this).parent().attr('id');

        let settings = {
            "url": senpai_notice_ajax_params.ajaxurl,
            "method": "POST",
            "timeout": 0,
            "headers": {
              "Content-Type": "application/x-www-form-urlencoded"
            },
            "data": {
              "nonce": senpai_notice_ajax_params.nonce,
              "id": id,
              "action": "dashboard_notice_senpai"
            }
        };
        $.ajax(settings).done(function (response) {
            console.log(response);
        });
   }); 
});