@extends('layouts.user')

@section('css')
  <!--Dropdzone-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
  <link rel="stylesheet" href="/css/user.css">
@endsection

@section('context')
<div class="container">
    <form action="{{route('dropzone')}}" method="POST" class="dropzone dz-clickable mb-5" id="addImages" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="dz-default dz-message m-5"><span>Drop/Click here to upload images</span></div>
        <div class="fallback">
            <input name="file_image" type="file" multiple />
        </div>

        <!-- Now setup your input fields -->
        <input type="text" name="name" />

        <button type="submit" id="uploadButton" class="btn btn-primary btn-block">Click Me</button>
    </form>
</div>
    
    
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

    <script>
    
    Dropzone.options.addImages = {
        autoProcessQueue: false,
        paramName: 'file',
        url: '{{route("dropzone")}}',
        init: function () {

            var myDropzone = this;


            // Update selector to match your button
            $("#uploadButton").click(function (e) {
                e.preventDefault();
                myDropzone.processQueue();
            });
            
            this.on("sendingmultiple", function() {
              // Append all form inputs to the formData Dropzone will POST
              var data = $("input[type='file']").serializeArray();
                $.each(data, function(key, el) {
                    formData.append(el.name, el.value);
                    console.log(el)
                });
            });

            // this.on('sending', function(file, xhr, formData) {
            //     // Append all form inputs to the formData Dropzone will POST
            //     var data = $("input[type='file']").serializeArray();
            //     $.each(data, function(key, el) {
            //         formData.append(el.name, el.value);
            //         console.log(el)
            //     });
            // });
        }
    }
    
    </script>
@endsection