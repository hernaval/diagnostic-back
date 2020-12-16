<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code d'activation</title>
</head>
<body>
    <div >
        <div >
            <img src="" width="100" alt="">
        </div>

        <div>
        <p>Bonjour, {{$data["fullname"]}}</p>
   
        <p >@lang('firstmail.merci')</p>
            <p >ACADYS DIAGNOSTIC vous remercie de votre inscription,
                 veuillez votre code d'activation utilisable une seule fois.
            </p>
        <p >Email : <span style="font-weigth : bold;font-size : 18px">{{$data["username"]}}</span> </p>
        <p>Code d'activation : <span style="font-weigth : bold;font-size : 18px"> {{$data['code']}} </span>  </p>
            
        <p>Merci.</p>
        </div>

        <div></div>
    </div>
</body>
</html>