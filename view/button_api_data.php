<?php
/*---------------*/
/* Nice button to get data */
/*---------------*/
?>

<form id="get-api-button" method="post">
    <label>Etsy API Key</label>
    <input required type="text" name="api_key"/>
    <button type="submit" class="button-submit">Submit</button> 
</form>

<p class="hide"id="show-data-api"></p>

<!-- The Modal -->
<div id="modal-select-insertData" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p style="font-size: 16px;">Please select an option below</p>
    <span style=
    "display: flex;
    justify-content: space-evenly;">
        <button id="insert-delete">Insert new data and delete old</button>
        <button id="insert-new">Continue insert new data</button>
    </span>
  </div>

</div>

<style>
    #get-api-button {
        display: table-caption;
        margin-top: 20px;
        margin-left: 20px;
    }

    #get-api-button label {
        font-size: 14px;
    }

    #get-api-button input[type=text] {
        margin-top: 10px;
        width: 250px;
        border-radius: 5px;
        border: 1px solid grey;
    }

    .hide {
        display: none;
    }

    .button-submit {
        border: none;
        background: #4f94d4;
        border-radius: 5px;
        padding: 10px 15px;
        margin-top: 30px;
        color: white;
    }

    .button-submit:hover {
        background-color: green;
        cursor: pointer;
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

    /* Modal */
  
    .modal {
    display: none; 
    position: fixed; 
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
    }

    /* Modal Content/Box */
    .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 30%;
    }

    /* The Close Button */
    .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    }

    .close:hover,
    .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
    }

    #insert-delete, #insert-new {
        padding: 10px;
        color: white;
        border-radius: 10px;
        font-size: 14px;
    }

    #insert-delete {
        background: green;
        border: 1px solid green;
    }

    #insert-new {
        background: #b5b525;
        border: 1px solid yellow;

    }

    #insert-delete:hover, #insert-new:hover {
        cursor: pointer;
        text-decoration: none;
    }

    #insert-delete:hover {
        background-color: #046504;
    }

    #insert-new:hover {
        background-color: #90901d;

    }

</style>


<script type="text/javascript">
    let options = ''
    let data_input
    jQuery(document).ready(function($){
        $('#get-api-button').submit(function(e) {
            e.preventDefault();

             data_input = $(this).serialize();

             $("#modal-select-insertData").show();

            return false;
        })

        $(".close").click(function() {
            $("#modal-select-insertData").hide();
        })

        $("#insert-new").click(function() {
            call_ajax(type="new");
            $("#modal-select-insertData").hide();

        })
        $("#insert-delete").click(function() {
            call_ajax(type="delete")
            $("#modal-select-insertData").hide();

        })
     
    });
   
    var modal = document.getElementById("modal-select-insertData");
     window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
      
    }

function call_ajax(type) {
    jQuery(document).ready(function($){

        $.ajax({
                url: ajaxurl, 
                // url: "/wp-content/plugins/GET-DATA-API/includes/request.php", 
                type: "GET",
                data:{
                    action:'get_data', 
                    api_key: data_input,
                    type
                    },
                success: function(data) {
                    console.log("data >> ", data);
                  
                    if (data === 'Error0') {
                        $('#show-data-api').html('Data not found. Please try again!');
                        $('#show-data-api').removeClass('hide');
                        $('#show-data-api').css('width', '400px');
                    } else {
                        $('#show-data-api').html('Success!');
                        $('#show-data-api').removeClass('hide');

                    }
                    setTimeout(() => {
                        $('#show-data-api').addClass('hide');

                    }, 1000);
                
                },
              
            })           
    })

}
   
</script>