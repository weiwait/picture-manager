@extends('layouts.app')

@section('title', '图片列表')

@section('content')
    <div id="contain">
        <div>
            @foreach ($images as $image)
                <div class="images">
                    <img src="{{$image}}" alt="">
                    <a href="{{URL::action('IndexController@delete', [basename($image)])}}">删除图片</a>
                </div>
            @endforeach
            <div class="images" id="drop">
                +
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('#drop').on('dragover', function () {
            return false;
        }).on('drop', function (e) {
            var file = e.originalEvent.dataTransfer.files[0];
            var formData = new FormData();
            formData.append('_token', '{{csrf_token()}}');
            formData.append('picture', file);
            $.ajax({
                type: 'POST',
                url: '{{route('picture')}}',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data) {
                        window.location.reload();
                    }
                }
            });
            return false;
        })
    </script>
@endpush