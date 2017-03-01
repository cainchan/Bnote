<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title data-page-title="首页">首页</title>
    <!-- font-awesome -->
    <link href="https://o.qcloud.com/static_api/v3/assets/fontawesome/css/font-awesome.css" rel="stylesheet">
    <!-- 蓝鲸提供的移动端公用样式库 -->
    <link href="https://o.qcloud.com/static_api/v3/bk_mobile/bkui/dist/style/bkui.min.css" rel="stylesheet">
    <!-- 引入jQuery2.0 -->
    <script src="https://o.qcloud.com/static_api/v3/bk_mobile/assets/js/jquery-2.0.0.min.js"></script>
    <!-- 引入蓝鲸提供的公用js -->
    <script src="https://o.qcloud.com/static_api/v3/bk_mobile/bk/js/bk_mobile.js"></script>
    <script src="https://o.qcloud.com/static_api/v3/bk_mobile/assets/echart-3.3.1/echarts.min.js"></script>
</head>

<body class="bg-bright1" data-bg-color="bg-bright1">
    <nav class="bkui-sidenav bkui-sidenav-r" id="bkui_r_sidenav">
        <div class="bkui-sidenav-header">
            <div class="bkui-headimg-pic">
                <div class="bkui-circle-outline">
                    <div class="bkui-in-circle">
                        <img src="https://o.qcloud.com/static_api/v3/bk_mobile/bkui/dist/example/images/touxiang.png">
                    </div>
                    <div class="bkui-sidebar-tipsnum">
                        23
                    </div>
                </div>
            </div>
            <div class="bkui-headimg-quit">
                    <i class="fa fa-sign-out"></i>
                <span class="bkui-font-quit">退出</span>
            </div>
        </div>
        <div class="bkui-list bkui-sidebar-list">
            <a class="bkui-list-item" href="javascript:;">
                <i class="fa fa-home"></i>
                <span class="bkui-list-fl">首页</span>
                <i class="fa fa-angle-right bkui-list-fr bkui-list-fricon"></i>
            </a>
            <a class="bkui-list-item" href="javascript:;">
                <i class="fa fa-bookmark "></i>
                <span class="bkui-list-fl">知识中心</span>
                <i class="fa fa-angle-right bkui-list-fr bkui-list-fricon"></i>
            </a>
            <a class="bkui-list-item" href="javascript:;">
                <i class="fa fa-database"></i>
                <span class="bkui-list-fl">基础数据</span>
                <i class="fa fa-angle-right bkui-list-fr bkui-list-fricon"></i>
            </a>
            <a class="bkui-list-item" href="javascript:;">
                <i class="fa fa-coffee"></i>
                <span class="bkui-list-fl">在线办公</span>
                <i class="fa fa-angle-right bkui-list-fr bkui-list-fricon"></i>
            </a>
            <a class="bkui-list-item" href="javascript:;">
                <i class="fa fa-cog"></i>
                <span class="bkui-list-fl">管理中心</span>
                <i class="fa fa-angle-right bkui-list-fr bkui-list-fricon"></i>
            </a>
            <a class="bkui-list-item" href="javascript:;">
                <i class="fa fa-code"></i>
                <span class="bkui-list-fl">开发中心</span>
                <i class="fa fa-angle-right bkui-list-fr bkui-list-fricon"></i>
            </a>
        </div>
    </nav>
    <div class="bkui-mask" style="display:none;" id="sidebar_mask"></div>
    <section>
        <header class="bkui-header bkui-header-primary">
            <h1 class="bkui-header-title">MDNote</h1>
            <a href="javascript:void(0);" class="bkui-header-left" id="back"> <i class="fa fa-reply bkui-header-icon"></i> </a>
            <a href="javascript:void(0);" class="bkui-header-right right-envelop bkui_menu_btn" id="sidebar_demo3"> <i class="fa fa-user bkui-header-icon"></i> </a>
        </header>
    </section>