<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel= { csrfToken: '{{ csrf_token() }}' }</script>
        <script src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>

        

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


        <title>App</title>
        <style type="text/css" media="screen">
.divCenMid{font-family:Arial,sans-serif;font-size:14pt;font-style:normal;font-weight:700;text-align:center;vertical-align:middle;margin:0;}
.allbdrCenMid{border:.75pt solid windowtext;color:#000;font-family:Arial,sans-serif;font-size:10pt;font-style:normal;font-weight:400;text-align:center;vertical-align:middle;margin:0;}
.allbdrCenTop{border:.75pt solid windowtext;color:#000;font-family:Arial,sans-serif;font-size:10pt;font-style:normal;font-weight:400;text-align:center;vertical-align:top;margin:0;}
.allbdrLtMid{border:.75pt solid windowtext;color:#000;font-family:Arial,sans-serif;font-size:10pt;font-style:normal;font-weight:400;text-align:left;vertical-align:middle;margin:0;}
.allbdrLtTop{border:.75pt solid windowtext;color:#000;font-family:Arial,sans-serif;font-size:10pt;font-style:normal;font-weight:400;text-align:left;vertical-align:top;margin:0;}



.table-wrapper {
  max-width: 700px;
  overflow: scroll;
}

table {
  position: relative;
  border: 1px solid #ddd;
  border-collapse: collapse;
}

td, th {
  white-space: nowrap;
  border: 1px solid #ddd;
  padding: 20px;
}

th {
  background-color: #eee;
}

tbody tr td:first-of-type {
  background-color: #eee;
}   
</style>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>
    <div id="app">
        <navbar></navbar>
        <div class="container">
            <student ></student>
            
        </div>

    </div>
        <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
        <script src="{{asset('js/app.js')}}" ></script>
    </body>
</html>
