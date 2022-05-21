@extends('layouts.app')

@php
    /**
     * @var $shop \App\Classes\ShopClass
     */
@endphp

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-20">
                <br>
                <div class="h1" style="text-align: center">Магазины</div>
                <br>

                <div class="container-fluid">
                    <div class="row">
                        @foreach($shops as $shop)
                            <div class="col">
                                <div class="card">
                                    <div class="card-header" style="text-align: center">
                                        <div class="h3">
                                            <a href="{{ route('shop_one_get', ['id' => $shop->id]) }}">
                                                {{$shop->title}}
                                            </a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif


                                        <!--- <img src="{{asset('img/shopping-cart.png')}}" class="img-fluid" style="width: 20%" alt="img-thumbnail"> --->
                                        <div class="text-center">
                                            Категория: {{$shop->category}}
                                        </div>
                                        <br>

                                        <div class="h5 text-center">
                                            Продавец
                                        </div>
                                        <div class="list-group">
                                            <div class="list-group-item">
                                                Имя: {{$shop->seller->name}}
                                            </div>
                                            <div class="list-group-item">
                                                Почта: {{$shop->seller->email}}
                                            </div>
                                            <div class="list-group-item">
                                                Телефон: {{$shop->seller->phone}}
                                            </div>
                                            <div class="list-group-item">
                                                На счету: {{$shop->seller->cash}}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
