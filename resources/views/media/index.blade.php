@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-5">
            <form action="{{ route('media.store') }}"
                  method="post"
                  enctype="multipart/form-data"
                  class="form-horizontal"
                  id="mediaUploadForm"
            >
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text"
                               name="filename"
                               id="fileName"
                               class="form-control"
                               placeholder="Наименование изображения"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="media" class="col-sm-12" id="mediaLabel">
                        Выберите изображение (нажмите для выбора)
                    </label>
                    <input type="file" class="hidden" name="media" id="media">
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">Загрузить фотографию</button>
                    </div>
                </div>

                <ul id="serverMessages" class="text-danger">

                </ul>
            </form>
        </div>

        <div class="col-sm-offset-1 col-sm-6">
            <button type="button" class="btn btn-primary btn-lg" id="showRandBtn">Покажите мне случайное<br> изображение</button>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 text-center" id="gallery">
            @foreach($images as $image)
                @include('media.item')
            @endforeach
        </div>
    </div>

    @include('media.modal')
@stop