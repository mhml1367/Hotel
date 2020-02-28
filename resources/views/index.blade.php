<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>رزرو بوم گردی</title>
        <link rel="stylesheet" href="/asset/css/style.css">
        <link rel="stylesheet" href="/asset/css/bootstrap.min.css">
        <link href="/asset/css/persian-datepicker.css" rel="stylesheet">
        <meta name="_token" content="{{ csrf_token() }}">

    </head>
    <body class="bg-light">
        <div class="container">
            <div class="py-5 text-center">
                <img src="{{$rec->images["0"]}}"  class="d-block mx-auto mb-4" width="500px" >
                    <h2>{{$rec->type}}   {{$rec->name}}</h2>
            </div>

        </div>

        <div class="container">
          <div class="card-deck mb-3 text-center">


            <div class="card mb-4 box-shadow">
              <div class="row card-body">

                  <div class="col my-auto">
                        <label>تاریخ ورود</label>
                      <input class="form-group" type="text" id="Start">
                  </div>

                  <div class="col my-auto">
                      <label>تاریخ خروج</label>
                      <input class="form-group" type="text" id="End">
                  </div>
                  <div class="col my-auto">
                        <button type="button" id="sub" class="btn btn-lg btn-block btn-outline-primary">جستجو</button>
                </div>
              </div>
            </div>



          </div>
        </div>

<div id="title" class="text-center"><h2></h2></div>

    <div class="container">
    <div class="row">
    <div class="col pull-center">

        <div class="lds-ellipsis text-center" id="loadig" style="display: none">
        <div></div><div></div><div></div><div></div>
        </div>


    </div>
    </div>
    </div>
        <div class="container">

            <div id="HOTELS">

            </div>

          </div>

          <div class="modal fade" id="reserve" tabindex="-1" role="dialog" aria-labelledby="reserve" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <b class="modal-title" id="roomReserve"></b>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
      
                  <div class="modal-body">
                      <div class="row" id="calc"></div>
                      <hr>
                      <div class="row" id="Titelcontracts"></div>
                      <div class="row" id="contracts"></div>
                      <hr>
                      <div class="row">
                          <div class="col">
                              <div class="form-group">
                                  <label for="first_name" class="col-form-label">نام:</label>
                                  <input type="text" class="form-control" id="first_name">
                              </div>
                              <div class="form-group">
                                  <label for="national_code" class="col-form-label">کدملی</label>
                                  <input type="text" class="form-control" id="national_code">
                              </div>
                             
                          </div>
                          <div class="col">
                              <div class="form-group">
                                  <label for="last_name" class="col-form-label">نام خانوادگی</label>
                                  <input type="text" class="form-control" id="last_name">
                              </div>
                              <div class="form-group">
                                  <label for="phone_number" class="col-form-label">موبایل:</label>
                                  <input type="text" class="form-control" id="phone_number">
                              </div>
                              {{-- <div class="form-group">
                                  <label for="Foreign" class="col-form-label">خارجی:</label>
                                  <input type="checkbox" class="form-control" id="Foreign">
                              </div> --}}
                          </div>
                          <div class="col">
                                  <div class="form-group">
                                          <label for="Sir_Madam" class="col-form-label">آقا/خانم:</label>
                                          <select name="Sir_Madam" id="Sir_Madam">
                                                  <option value="M" selected>اقا</option>
                                                  <option value="F">خانم</option>
                                                </select>
                                      </div>
                              <div class="form-group">
                                  <label for="city" class="col-form-label">شهر مبدا:</label>
                                  <input type="text" class="form-control" id="city">
                              </div>
          
                          </div>
                      </div>
                  </div>
      
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف از رزرو</button>
                    <button type="button" class="btn btn-primary" id="send">درخواست رزرو</button>
                  </div>
                </div>
              </div>
            </div>



        <script src="/asset/js/jquery.min.js"></script>
        <script src="/asset/js/bootstrap.min.js"></script>
        <script src="/asset/js/notify.js"></script>
        <script src="/asset/js/persian-date.js" ></script>
        <script src="/asset/js/persian-datepicker.js" ></script>
        <script>
$('#Start').persianDatepicker({
    initialValue: true,
    initialValueType: 'en',
    format: "YYYY/MM/DD",
    autoClose: true
});

$('#End').persianDatepicker({
    initialValue: true,
    initialValueType: 'en',
    format: "YYYY/MM/DD",
    autoClose: true
});


  var idRoom="";
  var start_date="{{$rec->start_date}}";
  var end_date="{{$rec->end_date}}";
  var rooms="<?php echo json_encode($rec->rooms, JSON_PRETTY_PRINT) ?>";

  $("#sub").click(function () {
    document.getElementById('loadig').style.display = "initial";
    document.getElementById("title").innerHTML ="<h2>درحال جستجو</h2>";
    document.getElementById("HOTELS").innerHTML = "";
    $('html,body').animate({ scrollTop: 500 }, 'slow');

        dataSend = {
            token: "mzoc1CEq401565108119FTd7QvbGea",
            from : $("#Start").val(),
            to : $("#End").val(),
            hotel_id: 10019,
        };
        DataHotel(dataSend);
    });



     
function DataHotel(dataSend) {
    $.ajax({
        type: 'POST',
        url: 'http://recepshen.ir/api/fetchRooms',
        data: dataSend,
        success: function (D) {
          $('html,body').animate({ scrollTop: 900 }, 'slow');

            if(D["error"] == undefined){
                if(D["data"].length != 0){

                document.getElementById("title").innerHTML ="<h2>اتاق های موجود</h2>";
                document.getElementById('loadig').style.display = "none";

            var FIELD= "";
                rooms = D["data"]["rooms"];
            for (i = 0; i < D["data"]["rooms"].length; i++) {
                FIELD += "<div class=\"card mb-4 box-shadow\">";
                FIELD += "<div class=\"card-header\">";
                FIELD += "<h4 class=\"my-0 font-weight-normal text-right\">"+ D["data"]["rooms"][i]["name"] +"</h4>";
                FIELD += "</div>";
                FIELD += "<div class=\"row card-body\">";
                FIELD += "<div class=\"col my-auto\">";
                FIELD += "<img src=\""+ D["data"]["rooms"][i]["images"][0] +"\">";
                FIELD += "</div>";

                FIELD += "<div class=\"col my-auto\">";
                FIELD += "<div class=\"card-title pricing-card-title\">تعداد تخت"+ D["data"]["rooms"][i]["beds"] +"</div>";
                FIELD += "</div>";
                FIELD += "<div class=\"col my-auto\">";
                FIELD += "<div class=\"row\">";
                FIELD += "<div class=\"col my-auto\">";
                FIELD += "<button type=\"button\" class=\"btn btn-primary btn-block\" data-toggle=\"modal\" data-target=\"#reserve\"";
                FIELD += "data-idRoom=\""+ D["data"]["rooms"][i]["id"] +"\" data-id=\""+ [i] +"\" data-nameRoom=\""+ D["data"]["rooms"][i]["name"] +"\"";
                FIELD += "data-capacity=\""+ D["data"]["rooms"][i]["details"]["capacity"] +"\">رزرو اتاق</button>";
                FIELD += "</div>";
                FIELD += "<div class=\"col my-auto\">";
                FIELD += "شروع قیمت"+ D["data"]["rooms"][i]["contracts"][0]["price"];
                FIELD += "</div>";
                FIELD += "</div>";
                FIELD += "</div>";
                
                FIELD += "</div>";
                FIELD += "</div>";
               
            }
                document.getElementById("HOTELS").innerHTML = FIELD;
                }else{
                    document.getElementById("title").innerHTML ="<h2>اتاقی وحود نیست</h2>";
                    document.getElementById('loadig').style.display = "none";
                }
            }else{
                document.getElementById("title").innerHTML ="<h2>"+ D["error"]+"</h2>";
                document.getElementById('loadig').style.display = "none";
            }

        },
        error: function (e) {
            document.getElementById("title").innerHTML ="<h2>خطایی رخ داده لطفا دوباره تلاش نمایید</h2>";
            document.getElementById('loadig').style.display = "none";
        }

    });

};




$('#reserve').on('show.bs.modal', function (event) {
        var nameRoom = event.relatedTarget.dataset.nameroom;
            idRoom = event.relatedTarget.dataset.idroom;
        var id = event.relatedTarget.dataset.id;
        var from = event.relatedTarget.dataset.from ;
        var to = event.relatedTarget.dataset.to;
        var capacity = event.relatedTarget.dataset.capacity;

        var calc="";

            calc += "<div class=\"col\">";
            calc += "<div class=\"form-group\">";
            calc += "<lable> تاریخ رفت: "+start_date+"</lable>";
            calc += "</div>";
            calc += "</div>";

            calc += "<div class=\"col\">";
            calc += "<div class=\"form-group\">";
            calc += "<lable> تاریخ برگشت: "+end_date+"</lable>";
            calc += "</div>";
            calc += "</div>";

            calc += "<div class=\"col\">";
            calc += "<div class=\"form-group\">";
            calc += "<lable > تعداد نفرات: "+capacity+"</lable>";
            calc += "</div>";
            calc += "</div>";


        var contracts="";
        var Titelcontracts = "<div class=\"col\"><label>انتخاب نوع اقامت:</label></div>";

        for (az = 0; az < rooms[id].contracts.length; az++) {
            var breakfast="";
            var lunch="";
            var dinner="";
            var stay="";
            
            if (rooms[id].contracts[az].stay = 1) {
                 stay = "اقامت";
            }
            if (rooms[id].contracts[az].breakfast == 1) {
                 breakfast = "صبحانه";
            }
            if (rooms[id].contracts[az].lunch == 1) {
                lunch = "نهار";
            }
            if (rooms[id].contracts[az].dinner == 1) {
                dinner = "شام";
            }
            
            contracts += "<div class=\"col\">";
            contracts += "<div class=\"form-group\">";
            contracts += "<input type=\"radio\" name=\"gender\" value=\""+rooms[id].contracts[az].id+"\"> "+ stay +" "+ breakfast +" "+ lunch +" "+ dinner +"<br>";
            if (rooms[id].contracts[az].discount_price == null) {
                contracts += (rooms[id].contracts[az].price + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            }else{
                contracts += (rooms[id].contracts[az].discount_price + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                contracts += "<strike>"+(rooms[id].contracts[az].price + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")+"</strike>";
            }
            contracts += " ريال </input>";
            contracts += "</div>";
            contracts += "</div>";
        }
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('#roomReserve').text("رزرو "+nameRoom);
        modal.find('#Titelcontracts').html(Titelcontracts);
        modal.find('#contracts').html(contracts);
        modal.find('#calc').html(calc);
        // modal.find('nameRoom').text(nameRoom)
    });



    $("#send").click(function () {
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
    $.ajax({
        type: 'POST',
        url: "{{ route('post.hotels.reserve') }}",
        data: {
            hotel_id: "{{$rec->id}}",
            room_id: idRoom,
            contracts: $('input[name="gender"]:checked').val(),
            first_name: $("#first_name").val(),
            last_name: $("#last_name").val(),
            national_code: $("#national_code").val(),
            phone_number: $("#phone_number").val(),
            phone_number: $("#phone_number").val(),
            Sir_Madam: $("#Sir_Madam").val(),
            city: $("#city").val(),
            Foreign: $("#Foreign").val(),
            start_date: "{{$rec->start_date}}",
            end_date: "{{$rec->end_date}}",
        },
        success: function (Data) {
            if (Data["status"] == 0) {
                $("#send").notify(
                    Data["error"], "error",
                    { position:"right" }
                );
            }
            if (Data["status"] == 1) {
                window.location.replace(Data["data"]["payLink"]);
            }
        }
    });
});
        </script>
    </body>
</html>
