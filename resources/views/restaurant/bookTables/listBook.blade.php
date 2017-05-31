@extends('layouts.master')
@section('contents')

<div class="portlet light bordered">
<div class="portlet-title">
    <div class="caption uppercase">
        <i class="fa fa-book"></i> Quản lý lịch hẹn</div>
   
</div>
<div class="row">
    <div class="col-xs-12 col-sm-4 col-md-6 col-lg-5">
        <button onclick="addCourse();" class="btn green btn-circle"><i class="fa fa-plus"></i> Thêm mới</button>
    </div>
    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-7">
        <form method="get" action="">
            <input type="text" class="search-class form-control" id="search"  name="search"  placeholder="Nhập Thông Tin Tìm Kiếm">
        </form>
    </div>
</div>
<div class="portlet-body">
    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-hover" id="sample_1">
            <thead>
                <tr>
                   <th class="stl-column color-column">#</th>
                   <th class="stl-column color-column">Tên khách hàng</th>
                   <th class="stl-column color-column">Email</th>
                   <th class="stl-column color-column">Ngày đặt bàn</th>
                   <th class="stl-column color-column">Số điện thoại</th>
                   {{-- <th class="stl-column color-column">Trạng thái</th> --}}
                   <th class="stl-column color-column">Hành động</th>
                </tr>
                
            </thead>
            <tbody>
                @if($listBook) @foreach($listBook as $key => $list)
                <tr>
                    <td class="text-center"> {{ $key + 1 }} </td>
                    <td class="text-center" >{{ $list->client_name }} </td>
                    <td class="text-center"> {{ $list->email }} </td>
                    <td class="text-center"> {{ $list->date }} </td>
                    <td class="text-center"> {{ $list->party_number }} </td>
                    {{-- <td class="text-center"> 
                      @if ($course->status == 1)
                        Hiển thị
                      @else
                        Ẩn
                      @endif
                    </td> --}}
                    <td class="text-center"> 
                        <a href="{{route('book-tables.show', $list->id)}}" class="btn btn-outline btn-circle btn-sm blue">
                            <i class="fa fa-eye" aria-hidden="true"></i> Xem 
                        </a>
                        <a href="{{route('book-tables.edit', $list->id)}}" class="btn btn-outline btn-circle green btn-sm purple">
                            <i class="fa fa-edit"></i> Sửa 
                        </a>
                        {{-- <form action="#" method="DELETE" style="display: initial;"> --}}
                          <a href="javascript:;" type="submit" onclick="alertDel({{$list->id}})" class="btn btn-outline btn-circle dark btn-sm red">
                            <i class="fa fa-trash-o"></i> Xóa 
                          </a>
                        {{-- </form> --}}
                        
                    </td>
                   
                </tr>
                @endforeach @else
                  <tr>
                    <td colspan="7" class="text-center"> Không có bản ghi nào </td>
                  </tr>
                @endif

            </tbody>
        </table>
    </div>
</div>
</div>

<script>
 function alertDel(id){

  var path = "{{URL::asset('')}}/admin/book-tables/" + id;

    swal({
        title: "Bạn có chắc muốn xóa?",
        // text: "Bạn sẽ không thể khôi phục lại bản ghi này!!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Không",
        confirmButtonText: "Có",
        
        // closeOnConfirm: false,
    },
    function(isConfirm) {
        if (isConfirm) {  

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              type: "DELETE",
              url: path,
              success: function(res)
              {
                if(!res.error) {
                    toastr.success('Xóa thành công!');
                    setTimeout(function () {
                        location.reload();
                    }, 1000)                   
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                toastr.error(thrownError);
              }
        });

            
        } else {
            toastr.info("Thao tác xóa đã bị huỷ bỏ!");
        }
    });
 }   
 </script>
@endsection
@section('footer')
 <script src="{{url('js/curd-Course.js')}}" type="text/javascript"></script>
 <script>
     function addCourse() {
         window.location = "{{route('book-tables.create')}}"
     }
 </script>
@endsection