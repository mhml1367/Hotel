<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>رزرو بوم گردی</title>
        <link rel="stylesheet" href="/asset/css/style.css">
        <link rel="stylesheet" href="/asset/css/bootstrap.min.css">

    </head>
    <body class="bg-light">
        <div class="container">
            <div class="py-5 text-center">
                <img src="{{$rec->images["0"]}}"  class="d-block mx-auto mb-4" width="500px" >
                    <h2>{{$rec->type}}   {{$rec->name}}</h2>
                <p class="lead">لاراوا</p>
            </div>

        </div>

        <div class="container">
          <div class="card-deck mb-3 text-center">


            <div class="card mb-4 box-shadow">
              <div class="row card-body">
                  <div class="col my-auto">
                      <button type="button" id="sub" class="btn btn-lg btn-block btn-outline-primary">جستجو</button>
                  </div>

                  <div class="col my-auto">
                      <input type="text" id="Start" value="1398/12/16">
                  </div>

                  <div class="col my-auto">
                      <input type="text" id="End" value="1398/12/17">
                  </div>
                
              </div>
            </div>



          </div>
        </div>

<div id="title" class="text-center"><h2>اتاق های موجود</h2></div>
<div class="lds-ellipsis" id="loadig" style="display: none">
  <div></div><div></div><div></div><div></div>
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
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <script>

  var idRoom="";
  var start_date="{{$rec->start_date}}";
  var end_date="{{$rec->end_date}}";
  var rooms="<?php echo json_encode($rec->rooms, JSON_PRETTY_PRINT) ?>";

  $("#sub").click(function () {

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
          $('html,body').animate({ scrollTop: 500 }, 'slow');

            if(D["error"] == undefined){
                if(D["data"].length != 0){

                document.getElementById("title").innerHTML ="<h2>اتاق های موجود</h2>";
                document.getElementById('loadig').style.display = "none";

            var FIELD= "";
            for (i = 0; i < D["data"]["rooms"].length; i++) {
                FIELD += "<div class=\"card mb-4 box-shadow\">";
                FIELD += "<div class=\"card-header\">";
                FIELD += "<h4 class=\"my-0 font-weight-normal text-right\">"+ D["data"]["rooms"][i]["name"] +"</h4>";
                FIELD += "</div>";
                FIELD += "<div class=\"row card-body\">";
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
                FIELD += "<div class=\"col my-auto\">";
                FIELD += "<h2 class=\"card-title pricing-card-title\">تعداد تخت"+ D["data"]["rooms"][i]["beds"] +"</h2>";
                FIELD += "</div>";
                FIELD += "<div class=\"col my-auto\">";
                FIELD += "<img src=\""+ D["data"]["rooms"][i]["images"][0] +"\">";
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

        </script>
    </body>
</html>
