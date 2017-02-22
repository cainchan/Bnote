<style type="text/css">
.note_body img{
    max-width: 100%;
}
</style>
<section>
    <div class="bkui-panel f16 m5">
        <div class="bkui-panel-header"><?php echo $note['title']?></div>
        <div class="bkui-panel-body">
            <div class="ui-component" style="position: relative; opacity: 1; z-index: auto; left: 5px; top: 5px;">
                <section>
                    <?php echo $note['html']?>
                </section>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="bkui-tabbar bkui-fixed-tabbar bkui-tabbar-light">
        <a class="bkui-tabbar-item bkui-tabbar-active" href="javascript:void(0);">
            <div class="bkui-tabbar-icon"> <i class="fa fa-edit"></i> </div>
            <p class="bkui-tabbar-label">编辑</p>
        </a>
        <a class="bkui-tabbar-item bkui-tabbar-active" href="javascript:void(0);">
            <div class="bkui-tabbar-icon"> <i class="fa fa-trash"></i> </div>
            <p class="bkui-tabbar-label">删除</p>
        </a>
        <a class="bkui-tabbar-item bkui-tabbar-active" href="javascript:void(0);">
            <div class="bkui-tabbar-icon"> <i class="fa fa-star-half-full"></i> </div>
            <p class="bkui-tabbar-label">置顶</p>
        </a>
        <a class="bkui-tabbar-item bkui-tabbar-active" href="javascript:void(0);">
            <div class="bkui-tabbar-icon"> <i class="fa fa-share-alt"></i> </div>
            <p class="bkui-tabbar-label">分享</p>
        </a>
    </div>
</section>