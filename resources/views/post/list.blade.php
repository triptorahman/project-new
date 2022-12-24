
@extends('layouts.master')
@section('content')

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Post List</h1>
                    </div>
                </div>
            </div>
           
            

        </div>
        @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-heading">
                            <button 
                                    class="btn btn-primary waves-effect waves-light m-1 pull-right" onclick="myFunction()" id="btnPrint">Export Pdf
                                <i class="fas fa-print"></i>
                            </button>
                        </div>
                        
                    <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <th>SL</th>
                        <th>Title</th>
                        <th>Short Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                       @foreach ($posts as $row)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                              <td>{{$row->title}}</td>
                              <td>{{$row->short_description}}</td>
                              
                              
                              <td>
                                @if($row->status==1)
                                    <div class="alert alert-success">Active</div>

                                
                                @else
                                    <div class="alert alert-warning">Inactive</div>

                                @endif

                              </td>

                            <td>
                               
                                <a href="{{route('posts.edit', $row['id'])}}"><i class="fas fa-edit"></i> Edit</a>{!! "&nbsp;&nbsp;" !!}
                                {{-- <a href="{{route('post.delete', $row['id'])}}"><i class="fas fa-trash"></i> Delete</a> --}}
                                <form method="post" action="{{route('posts.destroy',$row->id)}}" style="display:inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-xs text-white" data-toggle="tooltip" title="Delete" style="display:inline;padding:2px 5px 3px 5px;" onclick="return confirm('Are you sure to delete this?')"><i class="fas fa-trash"></i>Delete
                                    </button>
                                    <input type="hidden" value="{{auth()->user()->id}}" id='user_id'>
                                </form>

                                
                                
                               
                               
                                
                                

                            </td>
                           
                       </tr>
                        @endforeach
          
                    </tbody>
                  </table>
                        </div>
                    </div>
                </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        <div style="display: none" id="pdf_container"></div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script>


function myFunction() {
  
   
                
        var user_id = $('#user_id').val();
        console.log(user_id);
        
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo route('post-list-print') ?>",
            data: {
                _token: '{{csrf_token()}}',
                user_id,
                
                
            },
            beforeSend: function () {
                
            },
            success: function (data) {
                
                $('#pdf_container').empty();
                $('#pdf_container').html(data.schema);
                var divContents = $("#pdf_container").html();
                
                var printWindow = window.open('', '', 'height=700,width=900');
                printWindow.document.write(divContents);
                printWindow.document.close();
                printWindow.print();
            }
        });


            
}




            



</script>
