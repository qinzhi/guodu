<table class="table-form">
    <colgroup>
        <col width="150px"><col>
    </colgroup>
    <tbody>
        <tr>
            <th>商品名称：</th>
            <td>
                <div class="form-group has-feedback no-margin">
                    <input id="name" name="name" class="input-sm Lwidth400" type="text" pattern="required" maxlength="50">
                    <span class="note control-label margin-left-10">*</span>
                </div>
            </td>
        </tr>
        <tr>
            <th>商品描述：</th>
            <td>
                <div class="form-group has-feedback no-margin">
                    <input id="intro" name="intro" class="input-sm Lwidth400" type="text" maxlength="50">
                </div>
            </td>
        </tr>
        <tr>
            <th>关键字：</th>
            <td>
                <div class="form-group has-feedback no-margin">
                    <input id="search_words" name="search_words"  type="text" class="input-sm Lwidth300" maxlength="50"/>
                    <span class="note control-label margin-left-10">每个关键词最长为15个字符，必须以","(逗号)分隔符</span>
                </div>
            </td>
        </tr>
        <tr>
            <th>所属分类：</th>
            <td>
                <div class="form-group has-feedback no-margin">
                    <input id="category" class="input-sm Lwidth400" type="text">
                    <input id="category_id" name="category_id" class="hidden" type="text">
                </div>
            </td>
        </tr>
        <tr>
            <th>是否上架：</th>
            <td>
                <span class="control-group">
                    <div class="radio line-radio">
                        <label class="no-padding">
                            <input name="status" type="radio" checked="checked" value="0">
                            <span class="text">下架</span>
                        </label>
                    </div>
                    <div class="radio line-radio">
                        <label>
                            <input name="status" type="radio" value="1">
                            <span class="text">上架</span>
                        </label>
                    </div>
                </span>
            </td>
        </tr>
        <tr>
            <th>基本数据：</th>
            <td>
                <table class="table table-bordered table-hover table-border">
                    <thead>
                        <tr>
                            <th>商品货号</th>
                            <th>成本价</th>
                            <th>库存</th>
                            <th>重量(千克)</th>
                            <th>计量单位显示</th>
                            <th>排序</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="form-group has-feedback no-margin">
                                    <input class="input-xs Lwidth150" type="text" name="goods_no" pattern="required" maxlength="20">
                                </div>
                            </td>
                            <td>
                                <div class="form-group has-feedback no-margin">
                                    <input class="input-xs Lwidth80" type="text" name="cost_price" pattern="float" maxlength="10">
                                </div>
                            </td>
                            <td>
                                <div class="form-group has-feedback no-margin">
                                    <input class="input-xs Lwidth80" type="text" name="store_nums" pattern="int" maxlength="10">
                                </div>
                            </td>
                            <td>
                                <div class="form-group has-feedback no-margin">
                                    <input class="input-xs Lwidth80" type="text" name="weight" pattern="float" maxlength="10">
                                </div>
                            </td>
                            <td>
                                <div class="form-group has-feedback no-margin">
                                    <input class="input-xs Lwidth80" type="text" name="unit" maxlength="10">
                                </div>
                            </td>
                            <td>
                                <div class="form-group has-feedback no-margin">
                                    <input class="input-xs Lwidth80" type="text" name="sort" pattern="int" maxlength="5">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <th>批发价格：</th>
            <td>
                <table class="table table-bordered table-hover table-border">
                    <thead>
                        <tr>
                            <th>购买件数</th>
                            <th>平台价格</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="rule-list"></tbody>
                </table>
            </td>
        </tr>
        <tr>
            <th>批发规则：</th>
            <td>
                <a class="btn btn-success btn-sm pull-left no-radius" href="javascript:void(0);" id="addRule" data-status="true">
                    <i class="fa fa-plus"></i>
                    添加规则
                </a>
            </td>
        </tr>
        <tr>
            <th>商品类型：</th>
            <td>
                <div class="checkbox checkbox-inline no-margin no-padding">
                    <label class="no-padding">
                        <input type="checkbox" name="commend_type[]" value="1">
                        <span class="text">最新商品</span>
                    </label>
                </div>
                <div class="checkbox checkbox-inline no-margin">
                    <label>
                        <input type="checkbox" name="commend_type[]" value="2">
                        <span class="text">特价商品</span>
                    </label>
                </div>
                <div class="checkbox checkbox-inline no-margin">
                    <label>
                        <input type="checkbox" name="commend_type[]" value="3">
                        <span class="text">热卖商品</span>
                    </label>
                </div>
                <div class="checkbox checkbox-inline no-margin">
                    <label>
                        <input type="checkbox" name="commend_type[]" value="4">
                        <span class="text">推荐商品</span>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <th>商品图片：</th>
            <td>
                <ul class="cover-box">
                    <li class="last" id="add-image"></li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>
<script type="text/html" id="coverTpl">
    <li class="goods-img">
        <img src="{{img}}"/>
        <i class="delete glyphicon glyphicon-remove"></i>
        <input type="hidden" name="image[]" value="{{image}}"/>
        {{if (index > 0)}}
            <p class="set-cover">设为封面图</p>
        {{else}}
            <input type="hidden" id="cover-index" name="cover_index" value="{{index}}"/>
            <p class="set-cover active">封面图片</p>
        {{/if}}
    </li>
</script>
<script type="text/html" id="ruleTpl">
    <tr>
        <td>
            <div class="form-group has-feedback no-margin">
                <span>≥</span>
                <input class="input-xs Lwidth80" type="text" name="_num[]" pattern="required" maxlength="20">
            </div>
        </td>
        <td>
            <div class="form-group has-feedback no-margin">
                <input class="input-xs Lwidth80" type="text" name="_price[]" pattern="float" maxlength="10">
            </div>
        </td>
        <td>
            <a href="javascript:void(0);" class="btn btn-danger btn-xs shiny icon-only white btn-del"><i class="fa fa-times"></i></a>
        </td>
    </tr>
</script>
<script>
    $(function(){
        new GoodsImage();
        var ruleTpl = template('ruleTpl');
        var ruleList = $('#rule-list');
        ruleList.append(ruleTpl).find('td:eq(2)').find('a').remove();
        $('#addRule').click(function(){
            if(ruleList.children().length >= 3){
                Notify('最多添加三条批发规则', 'bottom-right', '5000', 'warning', 'fa-warning', true);
                return;
            }else
                ruleList.append(ruleTpl).find('tr:last-child').find('a').bind('click',function(){
                    var me = $(this).closest('tr');
                    bootbox.confirm("确定要删除么?", function (result) {
                        if(result){
                            me.remove();
                        }
                    });
                });
        });
    });
</script>