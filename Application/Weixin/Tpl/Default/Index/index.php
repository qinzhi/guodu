<extend name="Layout/base" />
<block name="quote-css">
    <link href="__CSS__/index.css?v={$version}" rel="stylesheet" type="text/css">
    <link href="__PLUGINS__/swiper/css/swiper.min.css?v={$version}" rel="stylesheet" type="text/css">
</block>
<block name="content">

<!-- 首页轮播图 开始 -->
<section class="swiper-container" id="swiper">
    <div class="swiper-wrapper">
        <volist name="banners" id="vo">
            <div class="swiper-slide">
                <a href="{$vo.link}">
                    <img src="{$vo.image|get_img}"/>
                </a>
            </div>
        </volist>
    </div>
    <ul class="swiper-pagination"></ul>
</section>
<script>
    $(function(){
        var mySwiper = new Swiper('#swiper', {
            autoplay : 3000,
            loop: true,
            pagination : '.swiper-pagination',
            paginationType : 'bullets',
            paginationClickable :true,
            paginationElement : 'li'
        })
    });
</script>
<!-- 首页轮播图 结束 -->

<!-- 快速入口 -->
<section class="fast-entrance">
</section>

<section class="product-area">
    <div class="product-title clearfix">
        <h3 class="pull-left">农庄直供</h3>
        <i class="pull-right icon icon-right"></i>
    </div>
    <div class="product-content">
        <ul class="product-list clearfix">
            <volist name="goods" id="vo">
                <li class="product-list-item">
                    <div class="product-img">
                        <img src="{$vo.cover_image|get_img}">
                    </div>
                    <div class="product-info">
                        <h3 class="product_name">{$vo.name}</h3>
                        <p class="product_intro">{$vo.intro}</p>
                        <div class="product-cost widthScale80">
                            <div class="pull-left">
                                <p class="product_price">
                                    <sup>￥</sup>
                                    <?php list($int,$decimal) = explode('.',$vo['sell_price']);?>
                                    <em>{$int}.</em>
                                    <i>{$decimal}</i>
                                    <unit>/{$vo.unit}</unit>
                                </p>
                            </div>
                            <div class="pull-right">
                                <p class="product-sell_num">已售{$vo.sale}{$vo.unit}</p>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="product-cart_add clear">
                            <i class="icon icon-add cart_add" data-rule='{$vo.rule|json_encode}' data-sku="{$vo.store_nums}" data-unit="{$vo.unit}" data-id="{$vo.id}"></i>
                        </div>
                    </div>
                </li>
            </volist>
        </ul>
        <p class="text-center" style="line-height: 2.5rem;background-color: #f0f4f0">~没有更多商品了~</p>
    </div>
</section>

</block>

<block name="quote-js">
    <script src="__JS__/cart.js?v={$version}"></script>
    <script src="__PLUGINS__/swiper/js/swiper.min.js?v={$version}"></script>
</block>