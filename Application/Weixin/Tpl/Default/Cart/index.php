<extend name="Layout/base" />
<block name="quote-css">
    <link href="__CSS__/cart.css?v={$version}" rel="stylesheet" type="text/css">
</block>
<block name="header">
    <header class="header clearfix">
        <div class="row-2-left flex">
            <div class="back">
                <a href="javascript:history.go(-1);"><i class="icon icon-left"></i></a>
            </div>
            <div class="title flex-1">进货单</div>
        </div>
    </header>
</block>
<block name="content">
    <section class="empty-cart-warp">
        <div class="empty-cart">
            <i class="icon icon-cart"></i>
            <p class="cart-tip">进货单空空的 赶快填饱它吧~</p>
            <a class="btn btn-primary btn-empty-cart" href="{:U('/category')}">去进货吧</a>
        </div>
    </section>
</block>