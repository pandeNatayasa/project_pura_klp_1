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
    
        // Dropzone.options.addImages = {
        // autoProcessQueue: false,
        // url: '{{route("dropzone")}}',
        // init: function () {

        //     var myDropzone = this;

        //     // Update selector to match your button
        //     $("#uploadButton").click(function (e) {
        //         e.preventDefault();
        //         myDropzone.processQueue();
        //     });

        //     this.on('sending', function(file, xhr, formData) {
        //         // Append all form inputs to the formData Dropzone will POST
        //         var data = $('#addImages').serializeArray();
        //         $.each(data, function(key, el) {
        //             // formData.append(el.name, el.value);
        //             console.log(el)
        //         });
        //     });
        // }
    // }
    Dropzone.options.addImages = { // The camelized version of the ID of the form element

// The configuration we've talked about above
autoProcessQueue: false,
uploadMultiple: true,
parallelUploads: 100,
maxFiles: 100,

// The setting up of the dropzone
init: function() {
  var myDropzone = this;

  // First change the button to actually tell Dropzone to process the queue.
  this.element.querySelector("button[type=submit]#addTemple").addEventListener("click", function(e) {
    // Make sure that the form isn't actually being sent.
    e.preventDefault();
    e.stopPropagation();
    myDropzone.processQueue();
  });

  // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
  // of the sending event because uploadMultiple is set to true.
  this.on("sendingmultiple", function() {
    // Gets triggered when the form is actually being sent.
    // Hide the success button or the complete form.
  });
  this.on("successmultiple", function(files, response) {
    console.log(files)
  });
  this.on("errormultiple", function(files, response) {
    // Gets triggered when there was an error sending the files.
    // Maybe show form again, and notify user of error
  });
}

}
    </script>
@endsection