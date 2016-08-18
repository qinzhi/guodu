<extend name="Layout/base" />
<block name="quote-css">
    <link href="__CSS__/category.css?v={$version}" rel="stylesheet" type="text/css">
</block>
<block name="page">
    <div class="page" id="page-category">
        <header class="bar bar-nav">
            <div class="searchbar">
                <a class="searchbar-cancel">取消</a>
                <div class="search-input">
                    <label class="icon icon-fangdajing" for="filtrate"></label>
                    <input type="search" id='filtrate' placeholder='检索种类名称...'/>
                </div>
            </div>
        </header>
        <include file="Layout:footer"/>
        <div class="content">
            <section class="category-area">
                <ul class="category-box"></ul>
            </section>
        </div>
    </div>
</block>
<block name="js">
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