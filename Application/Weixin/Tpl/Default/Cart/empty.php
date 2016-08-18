<extend name="Layout/base" />
<block name="quote-css">
    <link href="__CSS__/cart.css?v={$version}" rel="stylesheet" type="text/css">
</block>
<block name="page">
    <div class="page" id="page-cart">
        <header class="bar bar-nav">
            <a class="icon icon-left pull-left" href="javascript:history.go(-1);"></a>
            <h1 class="title">进货单</h1>
        </header>
        <include file="Layout:footer"/>
        <div class="content">
            <section class="empty-cart-warp">
                <div class="empty-cart">
                    <i class="icon icon-cart"></i>
                    <p class="cart-tip">进货单空空的 赶快填饱它吧~</p>
                    <a class="btn btn-primary btn-empty-cart" href="{:U('/category')}">去进货吧</a>
                </div>
            </section>
        </div>
    </div>
</block>