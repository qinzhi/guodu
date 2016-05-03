<div style="height: 5rem"></div>
<footer class="footer clearfix">
    <ul class="flex_card">
        <li class="flex-1 {$nav_type == 1?'active':''}">
            <a href="/">
                <i class="icon icon-zhuye"></i>
                <p class="text-center">首页</p>
            </a>
        </li>
        <li class="flex-1 {$nav_type == 2?'active':''}">
            <a href="{:U('/category')}">
                <i class="icon icon-suoyou"></i>
                <p class="text-center">分类</p>
            </a>
        </li>
        <li class="flex-1 {$nav_type == 3?'active':''}">
            <a href="{:U('/cart')}">
                <i class="icon icon-gouwuche"></i>
                <p class="text-center">货单</p>
            </a>
        </li>
        <li class="flex-1 {$nav_type == 4?'active':''}">
            <a href="{:U('/me')}">
                <i class="icon icon-quanyonghu"></i>
                <p class="text-center">我的</p>
            </a>
        </li>
    </ul>
</footer>