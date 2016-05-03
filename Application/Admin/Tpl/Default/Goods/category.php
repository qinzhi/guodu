<extend name="Layout/base" />
<block name="css">
    <link href="__CSS__/metroStyle/metroStyle.css" rel="stylesheet" >
</block>
<block name="content">
    <div class="row no-margin">
        <div class="col-lg-12 col-sm-12 col-xs-12 no-padding">
            <div class="widget flat no-margin">
                <div class="widget-header widget-fruiter">
                    <a class="btn btn-success" id="add" href="javascript:void(0);">添加</a>
                    <a id="save" class="btn btn-success" href="javascript:void(0);">保存</a>
                    <span class="division"> | </span>
                    <a id="delete" class="btn btn-danger" href="javascript:void(0);">删除</a>
                </div><!--Widget Header-->
                <div class="widget-body plugins_category-">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="well">
                                <table class="table table-bordered table-condensed table-middle flip-content dataTable">
                                    <thead class="flip-content bordered-palegreen">
                                    <tr>
                                        <th width="50%">分类名称</th>
                                        <th width="20%">状态</th>
                                        <th width="30%">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <volist name="categories" id="vo">
                                            <tr data-id="{$vo.id}">
                                                <td><img class="icon" src="{$vo.icon}" height="60px" width="60px"/><span class="name">{$vo.name}</span></td>
                                                <td>
                                                    <if condition="$vo.status eq 1">
                                                        <span class="status">开启</span>
                                                    <else/>
                                                        <span class="status">关闭</span>
                                                    </if>
                                                </td>
                                                <td>
                                                    <a class="btn btn-default btn-xs shiny icon-only success btn-move" href="javascript:void('上移');" data-action="up"><i class="fa fa-arrow-up"></i></a>
                                                    <a class="btn btn-default btn-xs shiny icon-only success btn-move" href="javascript:void('下移');" data-action="down"><i class="fa fa-arrow-down"></i></a>
                                                    <a class="btn btn-success btn-xs shiny icon-only white btn-get" href="javascript:void('编辑');"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        </volist>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="well">
                                <form action="{:U('GoodsCategory/edit')}" id="form-edit" class="form-horizontal bv-form form-category" data-action="edit" onsubmit="return false;" autocomplete="off">
                                    <div class="form-group has-feedback">
                                        <label class="col-lg-4 control-label">分类名称
                                            <span class="red">*</span>：
                                        </label>
                                        <div class="col-lg-8">
                                            <input name="name" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-lg-4 control-label">分类图标
                                            <span class="red">*</span>：
                                        </label>
                                        <div class="col-lg-8">
                                            <div class="input-group input-group-sm">
                                                <input type="text" readonly="" name="icon" id="icon-edit" pattern="required" class="form-control">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default btn-success" onclick="BrowseServer('icon-edit');" type="button">选择图片</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-lg-4 control-label">开启状态
                                            <span class="red">*</span>：
                                        </label>
                                        <div class="col-lg-8">
                                            <span class="control-group">
                                                <div class="radio line-radio">
                                                    <label class="no-padding">
                                                        <input type="radio" value="1" name="status">
                                                        <span class="text">开启</span>
                                                    </label>
                                                </div>
                                                <div class="radio line-radio">
                                                    <label>
                                                        <input type="radio" value="0" name="status">
                                                        <span class="text">关闭</span>
                                                    </label>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <!--<div class="form-group has-feedback">
                                        <label class="col-lg-4 control-label">分类颜色
                                            <span class="red">*</span>：
                                        </label>
                                        <div class="col-lg-8">
                                            <input class="form-control" type="text" id="colorValue" name="colorValue"/>
                                            <input name="color" id="color" type="hidden">
                                        </div>
                                    </div>-->
                                    <div class="form-group has-feedback">
                                        <label class="col-lg-4 control-label">SEO标题：</label>
                                        <div class="col-lg-8">
                                            <input name="title" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-lg-4 control-label">SEO关键词：</label>
                                        <div class="col-lg-8">
                                            <input name="keywords" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-lg-4 control-label">SEO描述：</label>
                                        <div class="col-lg-8">
                                            <span class="input-icon icon-right">
                                                <textarea name="descript" class="form-control"></textarea>
                                                <i class="fa  fa-rocket darkorange"></i>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!--Widget Body-->
            </div><!--Widget-->
        </div>
    </div>
    <div id="addModal" style="display:none;">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal bv-form form-category" method="post" data-action="add" action="{:U('GoodsCategory/add')}" autocomplete="off"></form>
            </div>
        </div>
    </div>
    <!--<div id="color_panel" class="tree_panel">
        <ul class="color-box">
            <li class="color-list" style="background-color: #ff655b;" data-color="red" data-value="红色">红色</li>
            <li class="color-list" style="background-color: #f2d659;" data-color="yellow" data-value="黄色">黄色</li>
            <li class="color-list" style="background-color: #4ece72;" data-color="green" data-value="绿色">绿色</li>
        </ul>
        <ul class="color-box">
            <li class="color-list" style="background-color: #b36edb;" data-color="purple" data-value="紫色">紫色</li>
            <li class="color-list" style="background-color: #47c2f1;" data-color="blue" data-value="蓝色">蓝色</li>
            <li class="color-list" style="background-color: #ffffff;" data-color="white" data-value="白色">白色</li>
        </ul>
    </div>-->
</block>
<block name="js">
<script>
    var category = {},tr = null;
    $(function(){
        $('#add').click(function(){
            bootbox.dialog({
                message: function(){
                    var form = $('#addModal .col-md-12 .form-category');
                    if(form.html() == ''){
                        var html = $('form.form-category').html();
                        html = html.replace(/icon-edit/g,'icon-tmp');
                        form.append(html);
                    }
                    else{form[0].reset();}
                    form.find('.position-root').hide();
                    return $("#addModal").html().replace(/icon-tmp/g,'icon-add');
                },
                title: "添加分类",
                className: "modal-sky",
                buttons: {
                    "cancel": {
                        label: "取消",
                        className: "btn-default",
                        callback: function () { }
                    },
                    "confirm": {
                        label: "确定",
                        className: "btn-success",
                        callback: function () {
                            $('.modal-dialog form.form-category').submit();
                        }
                    }
                }
            });
        });

        var panel = $('#color_panel');
        $('.color-box li').click(function(){
            var color = $(this).data('color');
            var value = $(this).data('value');
            $('#colorValue').val(value);
            $('#color').val(color);
            panel.hide();
        });
        $('#colorValue').on({
            focus: function(){
                panel.css({
                    left:$(this).offset().left + "px",
                    top:$(this).offset().top + $(this).outerHeight() - $('.navbar-inner').height() + "px",
                    width: $(this).outerWidth() + "px"
                }).slideDown("fast");
            }
        });
        $('#save').click(function(){
            if(category.id > 0){
                var query = $('.plugins_category- form').serialize();
                query += '&id=' + category.id;
                $.fruiter.post('{:U("GoodsCategory/edit")}',{params:encodeURIComponent(query)},function(result){
                    if(result.code == 1){
                        tr.find('.name').text(result.data.name);
                        tr.find('.icon').text(result.data.icon);
                        tr.find('.status').text((result.data.status)?'开启':'关闭');
                        Notify(result.msg, 'bottom-right', '5000', 'success', 'fa-check', true);
                    }else{
                        Notify(result.msg, 'bottom-right', '5000', 'danger', 'fa-bolt', true);
                    }
                });
            }else{
                Notify('请先选择分类', 'bottom-right', '5000', 'warning', 'fa-warning', true);
            }
        });
        $('#delete').click(function(){
            if(category.id > 0){
                bootbox.confirm("确定要删除<span class='red'>"+category.name+"</span>分类?", function (result) {
                    if (result) {
                        $.fruiter.post('{:U("GoodsCategory/del")}',{id:category.id},function(data){
                            if(data.code == 1){
                                $('.plugins_category- table').find('tr[data-id='+category.id+']').remove();
                                category = {};
                                document.getElementById('form-edit').reset();
                                Notify(data.msg, 'bottom-right', '5000', 'success', 'fa-check', true);
                            }else{
                                Notify(data.msg, 'bottom-right', '5000', 'danger', 'fa-bolt', true);
                            }
                        });
                    }
                });
            }else{
                Notify('请先选择分类', 'bottom-right', '5000', 'warning', 'fa-warning', true);
            }
        });
    });
</script>
<script>
$(function(){
    $('.plugins_category- table').find('.btn-get').click(function(){
        tr = $(this).parents('tr');
        if(!$(tr).hasClass('tr-focus')){
            $(tr).parent().find('.tr-focus').removeClass('tr-focus');
            $(tr).addClass('tr-focus');
        }
        var form = document.getElementById('form-edit');
        $.fruiter.post("{:U('GoodsCategory/getCategory')}",{id:$(tr).data('id')},function(data){
            if(data){
                category = data;
                form.name.value = data.name;
                form.icon.value = data.icon;
                $(form.status).removeAttr('checked');
                if(data.status == 1){
                    $(form.status).eq(0).attr('checked',true);
                }else{
                    $(form.status).eq(1).attr('checked',true);
                }
                form.title.value = data.title;
                form.keywords.value = data.keywords;
                form.descript.value = data.descript;
            }
        });
    });

    $('.plugins_category- table').find('.btn-move').click(function(){
        var action = $(this).data('action');
        var tr = $(this).parents('tr');
        if(!$(tr).hasClass('tr-focus')){
            $(tr).parent().find('.tr-focus').removeClass('tr-focus');
            $(tr).addClass('tr-focus');
        }
        var index = tr.index();
        var trs = $(tr).parents('tbody').find('tr');
        if(index == 0 && action == 'up' ){
            Notify('无法上移', 'bottom-right', '5000', 'warning', 'fa-warning', true);
        }else if(index == (trs.length-1) && action == 'down' ){
            Notify('无法下移', 'bottom-right', '5000', 'warning', 'fa-warning', true);
        }else{
            $.fruiter.post("{:U('GoodsCategory/move')}",{id:$(tr).data('id'),action:action},function(data){
                if(data.code == 1){
                    if (action == 'up') {
                        $(tr).insertBefore($(trs[index - 1]));
                    } else if (action == 'down') {
                        $(tr).insertAfter($(trs[index + 1]));
                    }
                    Notify(data.msg, 'bottom-right', '5000', 'success', 'fa-check', true);
                }else{
                    Notify(data.msg, 'bottom-right', '5000', 'danger', 'fa-bolt', true);
                }
            });
        }
    });
});
</script>
</block>