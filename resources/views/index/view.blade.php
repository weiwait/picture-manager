@extends('layouts.app')

@section('title', '图片列表')

@section('content')
<div id="drop" style="height: 500px;background: red;">
wefw
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
                    console.log(data)
                }
            });
            return false;
        })
    </script>
@endpush