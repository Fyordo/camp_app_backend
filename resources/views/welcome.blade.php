@php
use Illuminate\Support\Facades\URL;
/**
* @var $lines array
 */
@endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('public/css/app.css') }}">

    <title>Document</title>
</head>
<body>
<div class="container">
    <div id="images">
        <div class="about1">
            <img src="{{URL::asset('public/favicon.ico')}}" width="100" height="100" alt="">
        </div>

        <div class="about2" align="right">
            <h3>Иванов И.И.</h3>
        </div>

    </div>
    <br>
    <div class="content">
        <h3 class="heading">Админ панель - Статистика</h3>
        <!-- table__wrapper for y axis scrolling -->
        <div class="table__wrapper">
            <table class="table">
                <thead>
                <tr class="table__row">
                    <th class="table__heading">Мероприятие</th>
                    <th class="table__heading">Описание мероприятия</th>
                    <th class="table__heading">Отзывы</th>
                    <th class="table__heading">Время начала мероприятия</th>
                    <th class="table__heading">Время конца мероприятия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($lines as $line)
                    <tr class="table__row">
                        <td class="table__data">{{$line['event']}}</td>
                        <td class="table__data">{{$line['description']}}</td>
                        <td class="table__data">{{$line['rates']}}</td>
                        <td class="table__data">{{$line['beginning']}}</td>
                        <td class="table__data">{{$line['ending']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
