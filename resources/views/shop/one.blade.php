@extends('layouts.app')

@php
    /**
     * @var $shop \App\Classes\ShopClass
     * @var $seller \App\Classes\UserClass
     */
@endphp

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-20">
                <br>
                <div class="h1" style="text-align: center">Редактор "{{$shop->title}}"</div>
                <br>

                <div class="container-fluid">
                    <form method="POST" action="{{ route('shop_one_edit', ['id' => $shop->id]) }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">Название</label>

                            <div class="col-md-3">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $shop->title }}" required autocomplete="title" autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="category" class="col-md-4 col-form-label text-md-end">Категория</label>

                            <div class="col-md-3">
                                <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="name" value="{{ $shop->category }}" required autocomplete="category" autofocus>

                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Продавец</label>

                            <div class="col-md-3">
                                <select id="seller_id" name="seller_id">
                                    <option value="{{$shop->seller->id}}">{{$shop->seller->name}}</option>
                                    @foreach($sellers as $seller)
                                        @if($seller->id != $shop->seller->id)
                                            <option value="{{$seller->id}}">{{$seller->name}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Изменить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
