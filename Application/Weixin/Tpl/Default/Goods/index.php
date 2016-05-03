<extend name="Layout/base" />
<block name="quote-css">
    <link href="__CSS__/me.css?v={$version}" rel="stylesheet" type="text/css">
</block>
<block name="header">
    <header class="header clearfix">
        <div class="row-3 flex">
            <div class="back">
                <a href="javascript:history.go(-1);"><i class="icon icon-left"></i></a>
            </div>
            <div class="title flex-1">列表页</div>
            <div class="home">
                <a href="{:U('/')}"><i class="icon icon-zhuye"></i></a>
            </div>
        </div>
    </header>
</block>