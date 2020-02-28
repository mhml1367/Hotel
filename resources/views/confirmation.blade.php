<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>رزرو بوم گردی</title>
        <link rel="stylesheet" href="/asset/css/style.css">
        <link rel="stylesheet" href="/asset/css/bootstrap.min.css">
        <meta name="_token" content="{{ csrf_token() }}">

    </head>
    <body class="bg-light">
        <div class="container">
            <div class="py-5 text-center">
                <p class="lead">لاراوا</p>
            </div>

        </div>

        <div class="container">
          <div class="card-deck mb-3 text-center">


            <div class="card mb-4 box-shadow">
              <div class="row card-body">
                  <div class="col my-auto">
                        @isset ($rest->info)
                        <div class="text-center"><h2>پرداخت انجام شد</h2></div>
                        شماره رزرو شما {{$rest->info->factor_number}} و در تاریخ {{$rest->info->hotel->start_date}} در ساعت {{$rest->info->hotel->in_time}} حضور رسانید 
                        <br>
                        و تایید رزرو از طرف هتل برای شما پیامک می شود.
                        

                        @endisset

                        @isset ($rest->error)
                            <div class="text-center"><h2>پرداخت انجام نشد</h2></div>
                        @endisset
            
                  </div>
              </div>
            </div>



          </div>
        </div>
       




        <script src="/asset/js/jquery.min.js"></script>
        <script src="/asset/js/bootstrap.min.js"></script>
        <script src="/asset/js/notify.js"></script>

        
    </body>
</html>
