<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Display More Data</title>
</head>
<body>

   <h2>{{$data->title}}</h2>
   <p>{!!$data->content!!}</p>
   <p>{!!$data->sDate!!}</p>
   <p>{!!$data->eDate!!}</p>
   <p> <img src="{{url('/taskImages/'.$data->image)}}" alt=""  height="300" width="300"> </p>


</body>
</html>

