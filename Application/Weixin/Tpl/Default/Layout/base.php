<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <block name="title">
        <title>{$title?:'果来商城'}</title>
    </block>

    <link href="__COMMON__/css/base.css?v={$version}" rel="stylesheet" type="text/css">
    <meta name="description" content="{$seo['description']?:'水果'}">
    <meta name="keywords" content="{$seo['keywords']?:'水果'}">
    <script src="__COMMON__/js/zepto.min.js?v={$version}"></script>
    <script src="__COMMON__/js/guodu.js?v={$version}"></script>
    <block name="quote-css"></block>
    <block name="js"></block>
</head>
<body>
<block name="header">
    <header class="header clearfix">
        <div class="row-1">
            <h5 class="title">果来商城</h5>
        </div>
    </header>
</block>
<block name="content"></block>
<block name="footer">
    <include file="Default/Layout/Element/footer"/>
</block>
<script src="__COMMON__/js/template.js"></script>
<block name="quote-js"></block>
<block name="js"></block>
</body>
</html>