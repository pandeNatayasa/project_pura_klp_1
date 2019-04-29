@extends('member.layouts.layout_utama')

@section('add_css')
  <!-- Page level plugin CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/datatables/datatables.min.css')}}">
<script type="text/javascript">
  function formatRupiahStatic(angka)
  {
    var number_string = angka.toString(),
    split = number_string.split(','),
    sisa  = split[0].length % 3,
    rupiah  = split[0].substr(0, sisa),
    ribuan  = split[0].substr(sisa).match(/\d{1,3}/gi);
      
    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;  
    return rupiah;
  }
</script>
@endsection

@section('menu_list_product')
  current-page
@endsection

@section('content')
<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>List Temple | Member <!-- <small>sub title</small> --></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <!-- isi data -->
          <div class="card mb-3">
            @if($message =    Session::get('success'))
              <div class="alert alert-success">
                  <p>{{$message}}</p>
              </div>
            @endif
            @if($message = Session::get('warning'))
              <div class="alert alert-warning">
                  <p>{{$message}}</p>
              </div>
            @endif
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>ID</th>
                      <th>Gambar</th>
                      <th>Nama Produk</th>
                      <th>Harga</th>
                      <th>Date</th>
                      <th>Actions</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td></td>
                        <td></td>
                        <td><img style="height: 100px;" src=""></td>
                        <td></td>
                        <td >
                        </td>
                        <td></td>
                        <td>
                          <a href=""><button class="btn btn-info " data-toggle="tooltip" data-placement="right" title="Detail Product"><i class="fa fa-eye"></i></button></a>
                          <a href=""><button class="btn btn-primary " name="edit_produk" data-toggle="tooltip" data-placement="right" title="Edit Product"><i class="fa fa-edit"></i></button></a>
                          <button class="btn btn-danger " data-id_produk="" data-nama_produk="" data-toggle="modal"  name="confirm_delete" data-target="#modal_confirm_delete" data-toggle="tooltip" data-placement="right" title="Delete Produk"><i class="fa fa-trash"></i></button>
                        </td>
                        <td>
                        </td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- </div> -->

<!-- Modal Confirmation Delete-->
<div class="modal fade" id="modal_confirm_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Confirmation Delete Product</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        
        <div class="modal-body">
          <div class="row">
            <label id="text_delete" class="control-label col-md-12" style="margin-bottom: 10px;"></label>
          </div>
            
          <div class="modal-footer">
            <div class="row">
              <div class="col-md-offset-8 col-sm-offset-8 col-xs-offset-6 col-md-2 col-sm-2 col-xs-3">
                <button class="btn btn-succes " type="button" data-dismiss="modal">Cancel</button>  
              </div>
              <div class="col-md-2 col-sm-2 col-xs-3">
                <form method="POST" action="#">
                  {{method_field('delete')}}
                  {{csrf_field()}}
                  <input type="hidden" name="id_produk_delete" id="id_produk_delete" value="">
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </div>
            </div>
          </div>
      </div>
      
    </div>
  </div>
</div>
<!-- End Of Modal Confirmation Delete-->
@endsection

@section('add_js')
<script type="text/javascript" charset="utf8" src="{{asset('admin/vendors/datatables/datatables.min.js')}}"></script>

    <script type="text/javascript">
      $(document).ready( function () {
        $('#data').DataTable();
      } );

      //Modal Delete Shipping Cost
      $('#modal_confirm_delete').on('show.bs.modal', function (event) {
        console.log('Delete Order begin');

        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id_produk')
        var nama_produk = button.data('nama_produk')

        var modal = $(this)
        modal.find('.modal-body #text_delete').text('Apakah anda yakin akan menghapus Produk dengan ID : ' + id +', dengan nama Produk : '+nama_produk)
        modal.find('.modal-footer #id_produk_delete').val(id)
      })


    </script>
@endsection