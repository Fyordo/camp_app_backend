@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-20">
                <br>
                <div class="h1" style="text-align: center">Админ - панель</div>
                <br>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header" style="text-align: center">Магазины</div>

                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <img src="{{asset('img/shopping-cart.png')}}" class="img-fluid" style="width: 90%" alt="img-thumbnail">
                                    <div class="text-center">
                                        <a href="{{ route('shop_all') }}">
                                            Магазины
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header" style="text-align: center">Список вожатых</div>

                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <div class="img-fluid">

                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route('leaders') }}">Перейти</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header" style="text-align: center">Система баллов</div>

                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <div class="img-fluid">

                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route('points') }}">Система баллов</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header" style="text-align: center">Семьи</div>

                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <div class="img-fluid">

                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route('family') }}">Семьи</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header" style="text-align: center">Логи системы</div>

                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <div class="img-fluid">

                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route('logs') }}">Логи системы</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
