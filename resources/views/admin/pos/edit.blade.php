<div class="">
    <section id="new">
        <div class="modal-header">
            <div class="col-md-6 col-xs-6">
                <table>
                    <tr>
                        <td><h2><p id="Item" style="font-weight:bold;">尚未選擇項目</p></h2></td>
                        <td><h2><p id="Number" style="font-weight:bold;"></p></h2></td>
                    </tr>

                </table>
            </div>

            <div class="col-md-6 col-xs-6" id="Content">
                <table id="Flavor" align="center" class="table table-bordered">
                    <thead>
                    <td>@lang('default.flavor')</td>
                    <td>@lang('default.number')</td>
                    <td>@lang('default.money')</td>
                    <td>@lang('default.edit')</td>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <input id="order_serial_no" type="text" value="" style="display:none">
        </div>

        {{--<div class="row fontawesome-icon-list">--}}
            <div class="row">

                <div class="col-md-6 col-xs-6">
                    <table class="table table-borderless table-striped" id="gridview">
                        @if (isset($dtFlavor) and count($dtFlavor)>0)
                            @foreach($dtFlavor->chunk(3) as $Flavor)
                                <tr class="item" align="center">
                                    @foreach($Flavor as $item)
                                        <td>
                                            <div>
                                                @if($item->para_2==1)
                                                    <button type="button" class="btn btn-info PressFlavor " value="{{$item->money}}" data-info="{{$item->id}}" style="color:black;width:160px;height:50px"><span style="font-size:2em;">{{$item->para_1}}</span></button>
                                                @else
                                                    <button type="button" class="btn  PressFlavor btn-warning" value="{{$item->money}}" data-info="{{$item->id}}" style="color:black;width:160px;height:50px"><span style="font-size:2em;">{{$item->para_1}}</span></button>
                                                @endif
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
                <div class="col-md-6 col-xs-6">
                    <table class="table table-borderless table-striped" >
                        <tr class="item" align="center">
                            <td>
                                <button type="button" class="btn btn-default btn-lg Calculate" value="1" style="color:black;width:100px;height:50px">1</button>&nbsp&nbsp
                            </td>
                            <td>
                                <button type="button" class="btn btn-default btn-lg Calculate" value="2" style="color:black;width:100px;height:50px">2</button>&nbsp&nbsp
                            </td>
                            <td>
                                <button type="button" class="btn btn-default btn-lg Calculate" value="3" style="color:black;width:100px;height:50px">3</button>&nbsp&nbsp
                            </td>
                        </tr>
                        <tr clas="item" align="center">
                            <td>
                                <button type="button" class="btn btn-default btn-lg Calculate" value="4" style="color:black;width:100px;height:50px">4</button>&nbsp&nbsp
                            </td>
                            <td>
                                <button type="button" class="btn btn-default btn-lg Calculate" value="5" style="color:black;width:100px;height:50px">5</button>&nbsp&nbsp
                            </td>
                            <td>
                                <button type="button" class="btn btn-default btn-lg Calculate" value="6" style="color:black;width:100px;height:50px">6</button>&nbsp&nbsp
                            </td>
                        </tr>

                        <tr class="item" align="center">
                            <td>
                                <button type="button" class="btn btn-default btn-lg Calculate" value="7" style="color:black;width:100px;height:50px">7</button>&nbsp&nbsp
                            </td>
                            <td>
                                <button type="button" class="btn btn-default btn-lg Calculate" value="8" style="color:black;width:100px;height:50px">8</button>&nbsp&nbsp
                            </td>
                            <td>
                                <button type="button" class="btn btn-default btn-lg Calculate" value="9" style="color:black;width:100px;height:50px">9</button>&nbsp&nbsp
                            </td>
                        </tr>
                        <tr class="item" align="center">
                            <td>
                                <button type="button" class="btn btn-default btn-lg Correction" style="color:black;"><</button>
                            </td>
                        </tr>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="check">
                            <span class='glyphicon glyphicon-check'></span> @lang('default.add')
                        </button>
                        {{csrf_field()}}
                        <button type="button" class="btn btn-warning btn-finish" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> @lang('default.finish')
                        </button>
                    </div>
                </div>
            {{--</div>--}}
        </div>
    </section>
</div>