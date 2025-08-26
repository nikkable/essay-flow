<?php if($block): ?>
    <div class="trusted">
        <div class="container">
            <div class="trusted-head">
                <div class="trusted-image"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/trusted/code.png'; ?>"></div>
                <div class="trusted-title title title--words"><span>A+ Essays,</span><span>Custom-Written by</span><span class="text-bg"><span>Vetted</span><span>Academic</span><span>Experts.</span></span></div>
            </div>
        </div>
        <div class="trusted-main">
            <div class="trusted-item">Article review</div>
            <div class="trusted-item">Homework</div>
            <div class="trusted-item">Music review</div>
            <div class="trusted-item">Coursework</div>
            <div class="trusted-item">Business Plan</div>
            <div class="trusted-item">Presentation</div>
            <div class="trusted-item">Book review</div>
            <div class="trusted-item">Dissertation</div>
        </div>
        <div class="container">
            <div class="trusted-foot">
                <div class="trusted-desc">
                    <p>Whether you're crafting a college admission essay to stand out, a persuasive argument to sway opinions, or a deep literary analysis, our vetted experts tailor each word to your voice and goals. No generic templates, no AI fluff — just custom writing that meets your exact requirements, backed by research and polished to perfection.</p>
                    <p>From first draft to final revision, we’re here to ensure your ideas shine with clarity, impact, and academic rigor.</p>
                </div>
                <div class="trusted-image"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/trusted/image.jpg'; ?>"></div>
            </div>
        </div>
    </div>

    <!--
    <div class="trusted-item">
        <div class="trusted-item-name"><?= $block->content; ?></div>
        <div class="trusted-item-info">
            <div class="trusted-item-desc"><?= $block->content2; ?></div>
            <div class="trusted-item-icon">
                <?= file_get_contents(Yii::app()->theme->basePath . '/web/images/plus.svg') ?>
            </div>
        </div>
    </div>
    -->
<?php endif; ?>
