<section>
    <div id="bkui-tabs" class="bkui-tabs m0">
        <div class="bkui-tabs-nav"> <a href="javascript:void(0)" class="tabs-nav">目录</a>
        <a href="javascript:void(0)" class="tabs-nav active">最新</a>
        <a href="javascript:void(0)" class="tabs-nav">标签</a> </div>
        <div class="bkui-tabs-content p5">
            <div class="bkui-spacing">
                <?php foreach ($notes as $note): ?>
                    <div class="bkui-panel bkui-mb15 note" id="note_<?php echo $note['id'];?>">
                        <div class="bkui-panel-header note_title"><?php echo $note['title'];?></div>
                        <div class="bkui-panel-body note_body">
                            <?php echo substr($note['text'], 0,100).'...';?>
                        </div>
                        <div class="bkui-panel-footer note_footer"><?php echo $note['created_at'];?></div>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="tabs-content"> </div>
            <div class="tabs-content"> </div>
        </div>
    </div>
</section>