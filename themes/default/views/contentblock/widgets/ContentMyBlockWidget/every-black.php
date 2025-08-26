<?php if($block): ?>
    <div class="every every--dark">
        <div class="every-head">
            <div class="every-col">
                <div class="every-desc">Behind every groundbreaking idea is a message that resonates. We craft that message for CEOs, entrepreneurs, and change-makers who demand excellence.</div>
            </div>
            <div class="every-col">
                <div class="every-title title title--words"><span>Trusted by</span><span>Innovators & Leaders —</span><span>Where</span><span>Ideas</span><span class="text-bg-white"><span>Become</span><span>Influence.</span></span></div>
            </div>
        </div>
        <div class="every-main">
            <div class="every-item">
                <div class="every-item-col">
                    <div class="every-item-label">01</div>
                </div>
                <div class="every-item-col">
                    <div class="every-item-title">Disruptive tech startups scaling their narratives</div>
                </div>
            </div>
            <div class="every-item">
                <div class="every-item-col">
                    <div class="every-item-label">02</div>
                </div>
                <div class="every-item-col">
                    <div class="every-item-title">C-suite executives refining thought leadership</div>
                </div>
            </div>
            <div class="every-item">
                <div class="every-item-col">
                    <div class="every-item-label">03</div>
                </div>
                <div class="every-item-col">
                    <div class="every-item-title">NGOs advocating for global change</div>
                </div>
            </div>
            <div class="every-item">
                <div class="every-item-col">
                    <div class="every-item-label">04</div>
                </div>
                <div class="every-item-col">
                    <div class="every-item-title">Bestselling authors polishing manuscripts</div>
                </div>
            </div>
        </div>
        <div class="every-foot">
            <div class="where-image"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/where/bg.png'; ?>"></div>
        </div>
    </div>

    <!--
    <div class="every">
        <div class="container">
            <div class="every-head">
                <div class="every-title-top">
                    <?= file_get_contents(Yii::app()->theme->basePath . '/web/images/stars.svg') ?>
                </div>
                <div class="every-title title title--words"><?= $block->content; ?></div>
                <div class="every-main">
                    <div class="every-trusts">
                        <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted1', 'view' => 'every-item']); ?>
                        <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted2', 'view' => 'every-item']); ?>
                        <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted3', 'view' => 'every-item']); ?>
                        <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted4', 'view' => 'every-item']); ?>
                        <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted5', 'view' => 'every-item']); ?>
                        <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted6', 'view' => 'every-item']); ?>
                        <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted7', 'view' => 'every-item']); ?>
                        <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted8', 'view' => 'every-item']); ?>
                    </div>
                </div>
                <div class="every-foot">
                    <div class="every-image"><img src="<?= $block->getImageUrl(0, 0, false); ?>"></div>
                </div>
            </div>
        </div>
    </div>
    -->
<?php endif; ?>
