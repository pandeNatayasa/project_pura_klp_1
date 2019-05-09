@extends('layouts.user')

@section('css')
  <!--Dropdzone-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
  <link rel="stylesheet" href="/css/user.css">
@endsection

@section('context')
    <form action="{{route('dropzone')}}" method="POST" class="dropzone dz-clickable mb-5" id="addImages" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="dz-default dz-message m-5"><span>Drop/Click here to upload images</span></div>
        </form>

        <button type="submit" id="uploadButton" class="btn btn-primary btn-block">Click Me</button>
    
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

    <script>
    
        Dropzone.options.addImages = {
        autoProcessQueue: false,
        url: '{{route("dropzone")}}',
        init: function () {

            var myDropzone = this;

            // Update selector to match your button
            $("#uploadButton").click(function (e) {
                e.preventDefault();
                myDropzone.processQueue();
            });

            this.on('sending', function(file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                var data = $('#addImages').serializeArray();
                $.each(data, function(key, el) {
                    // formData.append(el.name, el.value);
                    console.log(el)
                });
            });
        }
    }
    </script>
@endsection