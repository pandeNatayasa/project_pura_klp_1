@extends('layouts.user')

@section('css')
  <!--Dropdzone-->
  <link rel="stylesheet" href="{{asset('css/user.css')}}">
@endsection

@section('context')
<div class="container mt-5 mb-5">
    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <a href="/" style="color:black"><i class="fa fa-arrow-left"></i></a>
                {{-- window.history.go(-1); return false; --}}
            </div>
            <div class="text-center">
                PROFILE
            </div> 
        </div>  
        <div class="card-body ">
            <div class="container">
                <div class="card  mx-auto" style="height: 200px; width:200px; border-radius: 50%; border: grey 6px solid" >
                    <img id="foto_profille" src="{{ asset(Auth::user()->profille_image)}}" style="width: 100%;height: 100%;position: static;border-radius: 50%;" alt="">
                    <input type="file" id="file1" name="image"  accept="image/*" capture style="display:none" onchange="showImage.call(this)"><button id="upfile1"  type="button" class="btn btn-default btn-circle btn-xl" style="z-index: 1;right:0;bottom:0;position: absolute"><i class="fa fa-camera"></i></button>
                </div>
                <div class="mt-5">
                <form action="/edit/profile/{{Auth::user()->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <!-- Form Nama User-->
                    <div class="form-group row">
                        <label for="inputNamaUser" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Nama<span class="required">*</span></label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                        <input type="text" class="form-control " id="user_name" name="user_name" value="{{Auth::user()->name}}" required>
                        </div>
                    </div>
                    <!-- Form Email User-->
                    <div class="form-group row">
                        <label for="inputEmailUser" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Email<span class="required">*</span></label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <input type="text" class="form-control " id="user_email" name="user_email" value="{{Auth::user()->email}}" required>
                        </div>
                    </div>
                    <!-- Form Telp User-->
                    <div class="form-group row">
                        <label for="inputTelpUser" class="col-sm-3 col-md-3 col-xs-12 col-form-label">No Telp<span class="required">*</span></label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <input type="text" class="form-control " id="user_telp" name="user_telp" value="{{Auth::user()->no_telp}}" required>
                        </div>
                    </div>
                    <!-- Form Password User-->
                    <div class="container text-center">
                        <button class="btn btn-primary btn-block" type="submit">Simpan</button>
                        <div class="mt-3">
                            <a data-toggle="modal" href="#passwordModal">Change Password ?</a>
                        </div>
                        
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Password-->
    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Password Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                    <div class="modal-body">
                        <form action="/change_password" method="POST">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <div class="col">
                                    <input type="password" name="password" class="form-control form-control-sm" placeholder="Password Confirmation">
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
<script>

// 
    // var input = document.querySelector('input[type=file]'); // see Example 4

    // input.onchange = function () {
    //     var file = input.files[0];

    //     // drawOnCanvas(file);   // see Example 6
    //     displayAsImage(file); // see Example 7
    // };


    // function displayAsImage(file) {
    //     var imgURL = URL.createObjectURL(file),
    //     img = document.createElement('img');

    //     img.onload = function() {
    //         URL.revokeObjectURL(imgURL);
    //     };

    //     img.src = imgURL;
    //     document.body.appendChild(img);
    // }
//

    $("#upfile1").click(function () {
        $("#file1").trigger('click');
    });

    // Javascript to show image are selected
    function showImage(){
        if( this.files && this.files[0]){
            var obj = new FileReader();

            obj.onload = function(data){
                var image = document.getElementById("foto_profille");
                image.src = data.target.result;
                image.style.display = "block";

                // Ajax to save into database
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"/user/update-foto-profille",
                    method:"POST",
                    data:{profille_image:data.target.result,_token:_token},
                    success:function(result)
                    {
                        // var image = document.getElementById("foto_profille");
                         // $("#foto_profille").attr('src','http://127.0.0.1:8000/'+result);
                        // image.src = 'http://127.0.0.1:8000/'+result;
                        // $('#foto_profille').src = 'http://127.0.0.1:8000/'+result;
                        // image.style.display = "block";                        
                        console.log('http://127.0.0.1:8000/'+result);
                    },
                    error(e)
                    {
                        console.log(e);
                    }
                })  
            }
            obj.readAsDataURL(this.files[0]);
        }
    }
    // End of show image
</script>
@endsection