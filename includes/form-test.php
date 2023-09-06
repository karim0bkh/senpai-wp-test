<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-color: gray;
            color: white; 
            text-align: center;
        }
        form {
            background-color: gray;
            padding: 20px; 
        }
        label, input, textarea {
            color: black; 
        }
    </style>
</head>
<body>
    <h1>Contact Form</h1>
    <form id = "contact_form">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone:</label>
        <input type="phone" id="phone" name="phone" required><br><br>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="5" cols="30" required></textarea><br><br>

        <input type="submit" id="submit" value="Submit">
    </form>

</body>
</html>

<script>
jQuery('#contact_form').submit(function(){
    event.preventDefault();
    var link="<?php echo admin_url('admin-ajax.php')?>";
    var form=jQuery('#contact_form').serialize();
    var formData=new FormData;
    formData.append('action','contact_us');
    formData.append('contact_us',form);
    jQuery('#submit').attr('disabled',true);
    jQuery.ajax({
        url:link,
        data:formData,
        processData:false,
        contentType:false,
        type:'post',
        success:function(result){
            jQuery('#submit').attr('disabled',false);
            if(result.success==true){
                jQuery('#contact_form')[0].reset();
            }
        }
    });
});    
</script>




