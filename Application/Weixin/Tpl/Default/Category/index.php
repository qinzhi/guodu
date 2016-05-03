<extend name="Layout/base" />
<block name="quote-css">
    <link href="__CSS__/category.css?v={$version}" rel="stylesheet" type="text/css">
</block>
<block name="header">
    <header class="header clearfix">
        <div class="row-category flex">
            <div class="menu"><i class="icon icon-fenlei"></i></div>
            <div class="search flex-1 padding-right-10"><input class="searchInput" id="filtrate" placeholder="检索分类名称" autocomplete="off"/></div>
            <!--<div class="action"><i class="icon icon-fangdajing"></i></div>-->
        </div>
    </header>
</block>
<block name="content">
    <section class="category-area">
        <ul class="category-box"></ul>
    </section>
    <script id="categoryTpl" type="text/html">
        {{each data as value}}
        <li class="box box-1">
            <a class="category-list" href="{:U('/goods')}">
                <div class="category-img"><img src="{{value.icon}}"/></div>
                <p class="category-name">{{value.name}}</p>
            </a>
        </li>
        {{/each}}
    </script>
    <script>
        $(function(){
            var data = {$categories|json_encode};
            var category_box = $('ul.category-box');
            if(data.length > 0){
                render(data);
            }
            function render(data){
                var tpl = template('categoryTpl',{data:data});
                category_box.html(tpl);
            }
			document.getElementById('filtrate').addEventListener('input', function(e){
				var val = $.trim(e.target.value);
                if(val.length > 0){
                    var tmpData = [];
                    $.each(data,function(){
                        if(this.name.indexOf(val) !== -1){
                            tmpData.push(this);
                        }
                    });
                    render(tmpData);
                }else{
                    render(data);
                }
			});
        });
    </script>
</block>
<block name="quote-js"></block>