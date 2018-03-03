@extends('admin.layouts.layout')
@section('css')
    <style>
        .animated{-webkit-animation-fill-mode: none;}
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>角色管理</h5>
            </div>
            <div class="ibox-content">
                <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">@lang('default.return')</a> &nbsp;
                @if(Auth::guard('admin')->user()->hasRule('admin.flavor.add'))
                    <div class="form-group row add">
                        <br>
                        <div class="col-md-4">
                            <button class="btn btn-primary btn-sm" type="submit" id="add">
                                <span class="glyphicon glyphicon-plus"></span> @lang('default.add')
                            </button>
                        </div>
                    </div>
                @endif


                <table class="table table-striped table-bordered table-hover m-t-md">
                    <thead>
                    <tr>
                        <th class="text-center">@lang('default.flavor_name')</th>
                        <th class="text-center">@lang('default.money')</th>
                        <th class="text-center">@lang('default.status')</th>
                        @if(Auth::guard('admin')->user()->hasRule('admin.flavor.edit'))
                            <th class="text-center">Actions</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($dtFlavor))
                        @foreach($dtFlavor as $item)
                            <tr class="item{{$item->id}}">
                                <td align="left"><p id = "flavor_name{{$item->id}}">{{$item->flavor_name}}</p></td>
                                <td align="left"><p id = "money{{$item->id}}">{{$item->money}}</p></td>
                                <td align="left"><p id = "status{{$item->id}}">{{$item->status}}</p></td>
                                <td>
                                    @if(Auth::guard('admin')->user()->hasRule('admin.flavor.edit'))
                                        <button class="edit-modal btn btn-info"
                                                data-info="{{$item->id}}">
                                            <span class="glyphicon glyphicon-edit"></span> @lang('default.edit')
                                        </button>
                                    @endif
                                    @if(Auth::guard('admin')->user()->hasRule('admin.flavor.destroy'))
                                        <button class="delete-modal btn btn-danger"
                                                data-info="{{$item->id}}">
                                            <span class="glyphicon glyphicon-trash"></span> @lang('default.delete')
                                        </button>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group hidden">
                                <label class="control-label col-sm-2 " for="id">id:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="id" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="Content">@lang('default.verses'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Content" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="Chapter">@lang('default.chapter'):</label>
                                <div class="col-sm-10">
                                    <input type="name" class="form-control" id="Chapter">
                                </div>
                            </div>
                        </form>
                        <div class="deleteContent">
                            Are you Sure you want to delete <span class="dname"></span> ? <span
                                    class="hidden did"></span>
                        </div>
                        <div class="modal-footer">
                            <p class="error text-center alert alert-danger hidden"></p>

                            <button type="button" class="btn actionBtn" data-dismiss="modal" id="editbtn">
                                <span id="footer_action_button" class='glyphicon'> </span>
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="AddModel" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group hidden">
                                <label class="control-label col-sm-2 " for="Addid">id:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Addid" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="AddContent">@lang('default.verses'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="AddContent" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="AddChapter">@lang('default.chapter'):</label>
                                <div class="col-sm-10">
                                    <input type="text" id="AddChapter" class="form-control"/>
                                    {{--<input type="name" class="form-control" id="Addmeeting_time">--}}
                                </div>
                            </div>
                        </form>
                        <div class="deleteContent">
                            Are you Sure you want to delete <span class="dname"></span> ? <span
                                    class="hidden did"></span>
                        </div>
                        <div class="add_modal-footer">
                            <p class="error text-center alert alert-danger hidden"></p>

                            <button type="button" class="btn actionBtn" data-dismiss="modal" id="addbtn">
                                <span id="add_action_button" class='glyphicon'> </span>
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-js')
    <script>


        $(document).on('click', '.edit-modal', function() {

            $('#myModal').modal('show');
        });

        $('.modal-footer').on('click', '.edit', function() {


            $.ajax({
                type: 'post',
                url: '',//'/admin/MAVersesEdit',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id':id,
                    'is_show': is_show,
                    'content': content,
                    'chapter': chapter
                },
                success: function(data) {
                    if (data['ServerNo']=='404'){
//                    alert(data['Result']);
                        $('.error').text(data['ResultData']);
                        $('.error').removeClass('hidden');
                        $('#myModal').modal('show');
                    }
                    else {
                        $('#content'+id).text(data['Data'].content);
                        $('#chapter'+id).text(data['Data'].chapter);
                    }
                },error:function(e)
                {
                    var errors=e.responseJSON;
                    alert(errors.Message);
                }
            });
        });


        /*
            當按下新增按鈕時，會去做的事情
        */
        $(document).on('click', '.btn-primary', function() {
        });

        function fillmodalData(details){


        }

        $("#addbtn").click(function() {
            // alert('test');
            $.ajax({
                type: 'post',
                url: '',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'content': $("#AddContent").val(),
                    'chapter': $('#AddChapter').val()
                },
                success: function(data) {
                    if (data['ServerNo']=='404'){
                        $('.error').text(data['ResultData']);
                        $('.error').removeClass('hidden');
                        $('#AddModel').modal('show');
                    }
                    else {
                        alert(data['ResultData']);
                        location.reload();
                    }
                },error:function(e){
                    var errors = e.responseJSON;
                }

            });

        });



        $(document).on('click', '.delete-modal', function() {

        });

        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'post',
                url: '',//'/admin/MAVersesDelete',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $('#id').val()
                },
                success: function(data) {
                    $('.item' + $('#id').val()).remove();
                }
            });
        });
    </script>
@endsection
