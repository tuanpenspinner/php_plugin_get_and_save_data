<?php
/*---------------*/
/* Nice button to get data */
/*---------------*/
?>


<button id="get-api-button">Hello</button> 

<p class="hide"id="show-data-api"></p>

<style>
    .hide {
        display: none;
    }

    #get-api-button {
        border: none;
        background: #4f94d4;
        border-radius: 5px;
        padding: 10px 15px;
        margin-top: 30px;
        color: white;
    }

    #show-data-api {
        text-align: center;
        background-color: green;
        color: white;
        width: 100px;
        padding: 10px 40px;
        margin: auto;
        transition: .4s;
        font-size: 16px;
    }

</style>


<script type="text/javascript">
              
    jQuery(document).ready(function($){
        $("#get-api-button").hover(function(){
            $(this).css("background-color", "green");
            $(this).css("cursor", "pointer");
            }, function(){
            $(this).css("background-color", "#4f94d4");
        });
        $('#get-api-button').click(function() {
            $.ajax({
                url: ajaxurl, 
                // url: "/wp-content/plugins/GET-DATA-API/includes/request.php", 
                type: "GET",
                data:{action:'get_data'},
                success: function(data) {
                    $('#show-data-api').html('Success!');
                    $('#show-data-api').removeClass('hide');

                    setTimeout(() => {
                        $('#show-data-api').addClass('hide');

                    }, 3000);
                
                },
                error: function() {
                    $('#show-data-api').html('Please try again!');
                }
            })           
            
        })
        
    });
</script>