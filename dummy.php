<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <style>
        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 80%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        @keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        /* The Close Button */
        .close {
            color: white;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            padding: 2px 16px;
            background-color: #5cb85c;
            color: white;
        }

        .modal-body {
            padding: 2px 16px;
        }

        .modal-footer {
            padding: 2px 16px;
            background-color: #5cb85c;
            color: white;
        }
    </style>
    </head>

    <body>

        <!-- Trigger/Open The Modal -->

        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2>Modal Header</h2>
                </div>
                <form id = "data-update">
                <div class="modal-body">
                   <input type = "text" name="sid" id="id" hidden="">
                    Receiver: <input type="text"  name="sreceiver"id="receiver"><br><br>
                    Sender: <input type="text" name="ssender" id="sender"><br><br>
                    Message: <input type="text" name="smessage" id="message"><br><br>
                    Flag: <input type="number"  name="sflag"id="flag"><br><br>
                    <input type="submit" id="update" name="update" value="update" >
                </div>
    </form>
                <div class="modal-footer">
                    <h3>Modal Footer</h3>
                </div>
            </div>

        </div>

        <div>
            <br>
            search: <input type="search" id="ssearch" name="search">
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Receiver</th>
                    <th scope="col">Sender</th>
                    <th scope="col">message</th>
                    <th scope="col">flag</th>
                </tr>
            </thead>
            <tbody id="result_table">

            </tbody>
        </table>


        <form id="form-data">
            <div>
                Receiver:<input type="text" name="receiver" id="Receiver"><br><br>
                Sender :<input type="text" name="sender" id="Sender"><br><br>
                message:<input type="text" name="message" id="message"><br><br>
                flag:<input type="text" name="flag" id="flag"><br><br>
                <button type="submit" id="save-button">Submit</button>
            </div>
        </form>
        <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

       
        <script type="text/javascript">
            
             //load data
            $(document).ready(function() {
                function loaddata() {
                    $("#result_table").html("");
                    $.ajax({
                        url: 'http://localhost/crudapi/fetchall.php',
                        type: 'POST',
                        contentType: 'application/json',
                        success: function(response) {
                            //console.log(response);
                            if (response.status == 'false') {
                                $("#result_table").append(
                                    "<tr><td><h2 style='text-align: end;'>" + response.message + "</h2></td></tr>");
                            } else {
                                $.each(response, function(key, value) {
                                    $("#result_table").append(
                                        "<tr>" +
                                        "<td><h2>" + value.id + "</h2></td>" +
                                        "<td><h2>" + value.receiver + "</h2></td>" +
                                        "<td><h2>" + value.sender + "</h2></td>" +
                                        "<td><h2>" + value.message + "</h2></td>" +
                                        "<td><h2>" + value.flag + "</h2></td>" +
                                        "<td><button class ='editid'  data-singleid='" + value.id + "'>Edit</td>" +
                                        "<td><button class ='delete_btn' data-deleteid='" + value.id + "'>Delete</td>" +
                                        "</tr>");
                                })

                            }

                        }
                    });
                }

                loaddata();

               //load data close

                //fetch single record 
                //show model box open
                $(document).on('click', '.editid', function() {
                    $('.modal').show();

                    //hide model box close
                    var dataid = $(this).data('singleid');
                    var object = {
                        sid: dataid
                    };
                    var MYJSON = JSON.stringify(object);
                  //  console.log(MYJSON);
                    $.ajax({
                        url: 'http://localhost/crudapi/fetchsingledata.php',
                        type: 'POST',
                        contentType: 'application/json',
                        data: MYJSON,
                        success: function(response) {
                        //   console.log(response);
                            $('#id').val(response['0']['id']);
                            $('#receiver').val(response['0']['receiver']);
                            $('#sender').val(response['0']['sender']);
                            $('#message').val(response['0']['message']);
                            $('#flag').val(response['0']['flag']);
                        }
                    })
                });
                //hide modal box open

                $('.close').on('click', function() {
                    $('.modal').hide();
                });
                //

                //hide model box close
                //Insert Data
                $("#save-button").on('click', function(e) {
                    e.preventDefault();
                    var arry_format = $("#form-data").serializeArray();
                    //console.log(arry_format);
                    var obj = {};
                    for (var a = 0; a < arry_format.length; a++) {
                        obj[arry_format[a].name] = arry_format[a].value;
                    }
                    var JSON_DATA = JSON.stringify(obj);
                    //  console.log(JSON_DATA);
                    $.ajax({
                        url: "insert-api.php",
                        type: "POST",
                        contentType : 'application/json',
                        data: JSON_DATA,
                        success: function(response) {
                            if (response.status == '200') {
                                loaddata();
                                $("#form-data").trigger('reset');

                            }
                        }
                    })

                })

               // insert data close


                //UPDATE DATA open
                $("#update").on('click', function(e) {
                    e.preventDefault();
                    var arry_format = $("#data-update").serializeArray();
                    //console.log(arry_format);
                    var obj = {};
                    for(var a = 0 ; a<arry_format.length ; a++){
                        obj[arry_format[a].name] = arry_format[a].value;
                    }
                      var JSON_DATA =JSON.stringify(obj);
                      //console.log(JSON_DATA);
                      $.ajax({
                        url : 'http://localhost/crudapi/update-api.php',
                        type: "POST",
                        contentType : 'application/json',
                        data: JSON_DATA,
                        success: function(response){
                           if(response.status == 'true'){
                            $('.modal').hide();
                            loaddata();
                           }
                    }
                      })
                });

//delete data open

$(document).on('click','.delete_btn',function(e){
      e.preventDefault();
      var delete_row = $(this).data('deleteid');
      var object = {sid : delete_row};
     // console.log(object);
      var Jsonvalue = JSON.stringify(object);
     // console.log(Jsonvalue);

     $.ajax({
       url : 'delete-api.php',
       type:'POST',
       contentType : 'application/json',
       data: Jsonvalue,
       success : function(response){
       // console.log(response);
        if(response.status = 'true'){
            loaddata();
        }

       }


     });

});

//delete data close


//search open
$('#ssearch').on('keyup',function(){
     var search_data = $(this).val();
     var object ={search:search_data};
     var Json = JSON.stringify(object);
     $("#result_table").html("");
   
     $.ajax({
        url:'search-api.php',
        type:'POST',
        contentType : 'application/json',
        data:Json,
        success: function(response) {
                            
                            if (response.status == 'false') {
                                $("#result_table").append(
                                    "<tr><td><h2 style='text-align: end;'>" + response.message + "</h2></td></tr>");
                            } else {
                                $.each(response, function(key, value) {
                                    $("#result_table").append(
                                        "<tr>" +
                                        "<td><h2>" + value.id + "</h2></td>" +
                                        "<td><h2>" + value.receiver + "</h2></td>" +
                                        "<td><h2>" + value.sender + "</h2></td>" +
                                        "<td><h2>" + value.message + "</h2></td>" +
                                        "<td><h2>" + value.flag + "</h2></td>" +
                                        "<td><button class ='editid'  data-singleid='" + value.id + "'>Edit</td>" +
                                        "<td><button class ='delete_btn' data-deleteid='" + value.id + "'>Delete</td>" +
                                        "</tr>");
                                })

                            }

                        }
  

     });
});


//search close



            });
        </script>
    </body>

</html>