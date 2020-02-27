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
                <div class="card-header">
                  <h4 class="my-0 font-weight-normal">Free</h4>
                </div>
                <div class="row card-body">
                    <div class="col my-auto">
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button>
                    </div>

                    <div class="col my-auto">
                        <img src="">
                    </div>
                    <div class="col my-auto">
                      <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
                    </div>
                  
                </div>
              </div>



            </div>
          </div>


        <script src="/asset/js/jquery.min.js"></script>
        <script>

  var idRoom="";
  var start_date="{{$rec->start_date}}";
  var end_date="{{$rec->end_date}}";
  var rooms=<?php echo json_encode($rec->rooms, JSON_PRETTY_PRINT) ?>;



        </script>
    </body>
</html>
