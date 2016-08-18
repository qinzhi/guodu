<extend name="Layout/base" />
<block name="quote-css">
    <link href="__CSS__/me.css?v={$version}" rel="stylesheet" type="text/css">
</block>

<block name="page">
    <div class="page" id="page-me">
        <header class="bar bar-nav">
            <a class="icon icon-left pull-left" href="javascript:history.go(-1);"></a>
            <h1 class="title">个人中心</h1>
        </header>
        <div class="content">
            <section class="me-box">
                <div class="me-avatar">
                    <div class="img-border">
                        <img src="http://wx.qlogo.cn/mmopen/Jq8SNDtQU9p3YFbp9To4OQQib8LJxzDVB8WPvyQFWqRXV9I6ictCntE1L7XfF86eq1bxRkSxhw6GgWo4S8icT49yXyn08Ql0eQT/132"/>
                    </div>
                    <p class="me-name">啊秦智</p>
                </div>
                <div class="me-asset flex">
                    <div class="me-coupon flex-1">
                        <a href="javascript:;">
                            <p class="num">0</p>
                            <p class="name">优惠券</p>
                        </a>
                    </div>
                    <div class="me-wallet flex-1">
                        <a href="javascript:;">
                            <p class="num">0</p>
                            <p class="name">余额</p>
                        </a>
                    </div>
                </div>
            </section>
            <section class="me-center">
                <div class="center_inner me-order first">
                    <a href="javascript:;" class="flex">
                        <div class="inner-name"><p>全部订单</p></div>
                        <div class="text-right inner-icon flex-1">
                            <span class="order-tip">查看全部订单</span>
                            <i class="icon icon-right"></i>
                        </div>
                    </a>
                </div>
                <div class="list-box flex">
                    <div class="order-status flex-1">
                        <a href="javascript:;">
                            <i class="icon icon-daifukuan"></i>
                            <p class="order-status-name">待付款</p>
                            <i class="badge badge-danger order-count">1</i>
                        </a>
                    </div>
                    <div class="order-status flex-1">
                        <a href="javascript:;">
                            <i class="icon icon-daifahuo"></i>
                            <p>待发货</p>
                        </a>
                    </div>
                    <div class="order-status flex-1">
                        <a href="javascript:;">
                            <i class="icon icon-daipingjia"></i>
                            <p>待评价</p>
                        </a>
                    </div>
                </div>
                <div class="center_inner me-order">
                    <a href="javascript:;" class="flex">
                        <div class="inner-name"><p>个人资料</p></div>
                        <div class="text-right inner-icon flex-1">
                            <i class="icon icon-right"></i>
                        </div>
                    </a>
                </div>
                <div class="center_inner me-order">
                    <a href="javascript:;" class="flex">
                        <div class="inner-name"><p>我的收藏</p></div>
                        <div class="text-right inner-icon flex-1">
                            <i class="icon icon-right"></i>
                        </div>
                    </a>
                </div>
                <div class="center_inner me-order">
                    <a href="javascript:;" class="flex">
                        <div class="inner-name"><p>使用帮助</p></div>
                        <div class="text-right inner-icon flex-1">
                            <i class="icon icon-right"></i>
                        </div>
                    </a>
                </div>
                <div class="center_inner me-order last">
                    <a href="javascript:;" class="flex">
                        <div class="inner-name"><p>意见反馈</p></div>
                        <div class="text-right inner-icon flex-1">
                            <i class="icon icon-right"></i>
                        </div>
                    </a>
                </div>

                <div class="me-logout">
                    <a class="btn btn-block btn-danger no-radius">退出</a>
                </div>
            </section>
        </div>
    </div>
</block>