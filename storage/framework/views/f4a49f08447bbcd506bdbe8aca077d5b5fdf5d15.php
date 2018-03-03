<?php $__env->startSection('css'); ?>
    <style>
        .animated{-webkit-animation-fill-mode: none;}
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row" id="divOrderInfo">
        <div class="col-sm-12">
            
                
            
            <div class="ibox-content">
                    <button type="button" class="btn btn-primary btn-lg " onclick="showicon()" value="60" data-info="">
                        <i class="fa fa-plus-circle"></i><?php echo app('translator')->getFromJson('default.order'); ?>
                    </button>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive text-center">
                    <table class="table table-borderless table-striped" id="dtOrderInfo">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo app('translator')->getFromJson('default.customer_no'); ?></th>
                                <th class="text-center"><?php echo app('translator')->getFromJson('default.flavor'); ?></th>
                                <th class="text-center"><?php echo app('translator')->getFromJson('default.money'); ?></th>
                                <th class="text-center"><?php echo app('translator')->getFromJson('default.action'); ?></th>
                                <th class="text-center"><?php echo app('translator')->getFromJson('default.status'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($dtUserOrder)): ?>
                                <?php $__currentLoopData = $dtUserOrder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $UserOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="item" id="<?php echo e($UserOrder->order_serial_no); ?>">
                                            <td><?php echo e($UserOrder->order_serial_no); ?></td>
                                            <td><?php echo $UserOrder->flavor_name; ?></td>
                                            <td><?php echo e($UserOrder->money); ?></td>
                                            <td>
                                                <button type='button' class='btn btn-primary btn-edit' value='<?php echo e($UserOrder->order_serial_no); ?>'>修改</button>
                                            </td>
                                            <td>
                                                <button type='button' class='btn btn-danger' value='<?php echo e($UserOrder->order_serial_no); ?>'>未完成</button>
                                            </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="functions" class="hide">
        <?php echo $__env->make('admin.pos.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer-js'); ?>
    <script>

        function showicon(){
            $('#divOrderInfo').addClass('hide');
            $('#functions').removeClass('hide');
            $OrderFlavor='';
            $OrderMoney=0;
            $OrderInfo=[];
            $("#Flavor tbody").html("");
            $('#Item').text('尚未選擇項目');
            $('#Number').text('');
//            $('.PressFlavor').removeClass('btn-success');
//            $('.PressFlavor').addClass('btn-default');
            $('.Calculate').removeClass('btn-success');
            $('.Calculate').addClass('btn-default');

//            layer.open({
//                type: 1,
//                title:'點餐',
//                area: ['1000px', '120%'], //宽高
//                anim: 2,
//                shadeClose: true, //开启遮罩关闭
//                content: $('#functions')
//            });
        }

        var $OrderFlavor='';
        var $FlavorID='';
        var $OrderNum='';
        var $OrderMoney='';
        var $OrderInfo = [];

        $('.PressFlavor').on('click',function(){
            $OrderFlavor='';
            $OrderMoney='';
//            $('.PressFlavor').removeClass('btn-success');
//            $('.PressFlavor').addClass('btn-default');
            $(this).addClass('btn-success');
            $(this).removeClass('btn-default');

            $OrderFlavor=$(this).text();
            $OrderMoney = $(this).val();
            $FlavorID = $(this).data('info');

            $('#Item').text($OrderFlavor );

        });

        $('.Calculate').on('click',function(){

            $OrderNum = $OrderNum+$(this).val();
            $('#Number').text('*'+$OrderNum);
            $('.Calculate').removeClass('btn-success');
            $('.Calculate').addClass('btn-default');
            $(this).addClass('btn-success');
            $(this).removeClass('btn-default');
        });


        $('.btn-cancel').on('click',function(){

        });

        $('#check').on('click',function(){

            if($OrderFlavor!='' && $OrderNum!=''){
                var $Order=[];
                $OrderMoney=$OrderMoney * $OrderNum;

                var trs = $('#Flavor').find('tr').length;
                var $Flag = false;

                for ( i=1; i<trs; i++ ) {
                     $HistoryOrderFlavorId = $('#Flavor').find("tr").eq(i).find("td").eq(4).text().trim();
//                     alert($HistoryOrderFlavorId+'-'+$FlavorID);
//                    alert($('#Flavor').find("tr").eq(i).find("td").eq(1).text()); // 注意-1是因为index从0开始计数
                    if($FlavorID == $HistoryOrderFlavorId)
                    {
                        $HistoryNumber =$('#Flavor').find("tr").eq(i).find("td").eq(1).text();
                        $HistoryMoney =$('#Flavor').find("tr").eq(i).find("td").eq(2).text();
//                        alert(parseInt($HistoryMoney));
                        $('#Flavor').find("tr").eq(i).find("td").eq(1).text(parseInt($OrderNum)+parseInt($HistoryNumber));
                        $('#Flavor').find("tr").eq(i).find("td").eq(2).text(parseInt($OrderMoney)+parseInt($HistoryMoney));

                        $OrderInfo[i-1][2]=parseInt($OrderNum)+parseInt($HistoryNumber);
                        $OrderInfo[i-1][3]=parseInt($OrderMoney)+parseInt($HistoryMoney);

                        $Flag=true;
                        break;
                    }
                }

                if($Flag==false){

                    $Order.push($FlavorID);
                    $Order.push($OrderFlavor);
                    $Order.push($OrderNum);
                    $Order.push($OrderMoney);
                    $OrderInfo.push($Order);

                    $('#Flavor').append("<tr id='"+trs+"'><td>"+$OrderFlavor+"</td><td align='right'>"+$OrderNum+"</td>" +
                        "<td align='right'>"+$OrderMoney+"</td><td align='left'>" +
                        "<button type='button' class='btn btn-danger item-edit' value='"+trs+"'>刪除</button></td>" +
                        "<td style='display:none'>"+$FlavorID+"</td></tr>");
                }


                $('#Item').text('尚未選擇項目');
                $('#Number').text('');
//                $('.PressFlavor').removeClass('btn-success');
//                $('.PressFlavor').addClass('btn-default');
                $('.Calculate').removeClass('btn-success');
                $('.Calculate').addClass('btn-default');


                $OrderFlavor='';
                $OrderNum='';
            }

        });

        $('.btn-finish').on('click',function(){
            $("#Flavor tbody").html("");

//            layer.closeAll();
            $('#divOrderInfo').removeClass('hide');
            $('#functions').addClass('hide');

            if($OrderInfo.length>0)
            {
                $.ajax({
                    type: 'post',
                    url: '<?php echo e(route('pos.create')); ?>',//'/admin/MAVersesEdit',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'OrderInfo':$OrderInfo,
                        'OrderSerialNo':$('#order_serial_no').val()
                    },
                    success: function(data) {
//                        $('#dtOrderInfo').load(location.href+" #dtOrderInfo>*","");
                        var $Money=0;
                        var $strFlavor='';

                        for (var i = 0; i < $OrderInfo.length; i++) {
                            if(typeof($OrderInfo[i])!= "undefined"){
                                $strFlavor=$strFlavor+$OrderInfo[i][1]+'*'+$OrderInfo[i][2]+'</br>';
                                $Money = $Money+ $OrderInfo[i][3];
                            }
                        }

                        if($('#order_serial_no').val()==""){
                                                                                                                                                                     
                            $('#dtOrderInfo').append("<tr id='"+data['ResultData']+"'><td>"+data['ResultData']+"</td><td>"+$strFlavor+"</td><td>"+$Money+"</td><td><button type='button' class='btn btn-primary btn-edit' value='"+data['ResultData']+"'>修改</button></td><td><button type='button' class='btn btn-danger' value='"+data['ResultData']+"'>未完成</button></td></tr>");

                        }else{
                            $strOrderRowId=$('#order_serial_no').val();
                            $("#"+$strOrderRowId).find("td").eq(1).text("").append($strFlavor);
                            $("#"+$strOrderRowId).find("td").eq(2).text($Money);

                        }
                        $OrderInfo=[];
                        $('#order_serial_no').val("");

                    },error:function(e)
                    {
                        var errors=e.responseJSON;
                        alert(errors.Message);
                    }
                });
            }
        });

        $('.Correction').on('click',function(){
            $OrderNum = $OrderNum.slice(0,$OrderNum.length-1);
            $('#Number').text('*'+$OrderNum);
        });

        $(document).on('click', '.btn-danger', function() {

            $Row = "#"+$(this).val();
            $($Row).remove();

            $.ajax({
                type: 'post',
                url: '<?php echo e(route('pos.UpdateStatus')); ?>',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'order_serial_no':$(this).val()
                },
                success: function(data) {

                },error:function(e)
                {
                    var errors=e.responseJSON;
                    alert(errors.Message);
                }
            });

        });

        $(document).on('click', '.item-edit', function() {
            $RowId=$(this).val();
            $('#'+$RowId).remove();

            delete $OrderInfo[$RowId-1];
        });

        $(document).on('click', '.btn-edit', function() {
            $strOrderSerialNo=$(this).val();
            $.ajax({
                type: 'get',
                url: '<?php echo e(route('pos.OrderDetail')); ?>',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'order_serial_no':$(this).val()
                },
                success: function(data) {

                    for(i=0;i<data['Data'].length;i++){

                        $('#Flavor').append("<tr id='"+parseInt(i+1)+"'><td>"+data['Data'][i].flavor_name+"</td><td align='right'>"+data['Data'][i].order_num+"</td>" +
                        "<td align='right'>"+data['Data'][i].money+"</td><td align='left'>" +
                        "<button type='button' class='btn btn-danger item-edit' value='"+parseInt(i+1)+"'>刪除</button></td>" +
                        "<td style='display:none'>"+data['Data'][i].flavor_id+"</td></tr>");
                        var $Order=[];
                        $Order.push(data['Data'][i].flavor_id);
                        $Order.push(data['Data'][i].flavor_name);
                        $Order.push(data['Data'][i].order_num);
                        $Order.push(data['Data'][i].money);

                        $OrderInfo.push($Order);
                    }
                    $('#order_serial_no').val($strOrderSerialNo);

//                    layer.open({
//                        type: 1,
//                        title:'點餐',
//                        area: ['1000px', '120%'], //宽高
//                        anim: 2,
//                        shadeClose: true, //开启遮罩关闭
//                        content: $('#functions')
//                    });
                    $('#divOrderInfo').addClass('hide');
                    $('#functions').removeClass('hide');

                },error:function(e)
                {
                    var errors=e.responseJSON;
                    alert(errors.Message);
                }
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>