<script>
    $(function(){
        $('#sidebar_mask').on('click', function(){
            $('body').removeClass('bkui-menu-open r-push l-push');
            $('.bkui-sidenav').removeClass('bkui-left-envelop bkui-right-envelop bkui-slide-menu');
        });
        $('#sidebar_demo3').on('click',function(){
            $('body').addClass('bkui-menu-open');
            $('#bkui_r_sidenav').addClass('bkui-right-envelop bkui-slide-menu');
            return false;
        });
    

        $('.bkui-tabs').on('click', '.tabs-nav', function(){
            if ($(this).hasClass('active')){
                return false;
            }
            var tabIndex = $(this).index();
            var tabBox = $(this).closest('.bkui-tabs');
            var tabHeader = tabBox.find('.tabs-nav');
            var tabContent = tabBox.find('.tabs-content');
            tabBox.children().children(".active").removeClass('active');
            $(this).addClass('active');
            tabContent.eq(tabIndex).addClass('active');
        });
    });
</script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//cdn.bootcss.com/highlight.js/8.5/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
</body>
</html>