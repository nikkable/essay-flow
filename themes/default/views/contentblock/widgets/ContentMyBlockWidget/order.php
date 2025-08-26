<?php if($block): ?>
    <div class="order-home-head">
        <div class="order-home-title title">See Your Price in Seconds — Fast, Fair & Flexible</div>
        <div class="order-home-desc desc">Budget-friendly or premium rush? Adjust your preferences and see the cost in real time. 100% transparent.</div>
    </div>
    <div class="order-home-main">
        <!--
        <div class="order-home-title-top">
            <?= file_get_contents(Yii::app()->theme->basePath . '/web/images/stars.svg') ?>
        </div>
        <div class="order-home-title title title--words" data-aos="fade-right"><?= $block->content; ?></div>
        <div class="order-home-desc" data-aos="fade-right"><?= $block->content2; ?></div>
        -->
        <div class="order-home-form">
            <input class="js-input-page" type="hidden" value="<?= Yii::app()->getModule('rackcalc')->pricePage; ?>">

            <div class="form-group">
                <label for=""><?= Yii::t('OtherModule.other', 'Subject'); ?></label>
                <div class="field-selected-wrap">
                    <select class="field-selected js-input-subject">
                        <?php foreach (Subjects::getSubjects() as $item): ?>
                            <option value="<?= $item->id; ?>" data-percent="<?= $item->cost; ?>"><?= $item->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for=""><?= Yii::t('OtherModule.other', 'Number of pages'); ?></label>
                <div class="field-selected-wrap">
                    <select class="field-selected js-input-word">
                        <?php foreach (Words::model()->findAll() as $item): ?>
                            <option value="<?= $item->id; ?>" data-percent="<?= $item->cost; ?>"><?= $item->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for=""><?= Yii::t('OtherModule.other', 'Periods'); ?></label>
                <div class="field-selected-wrap">
                    <select class="field-selected js-input-period">
                        <?php foreach (Periods::getPeriods() as $item): ?>
                            <option value="<?= $item->id; ?>" data-percent="<?= $item->cost; ?>"><?= $item->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="order-home-form-total">
            <div class="order-home-form-price js-total-price"><?= Yii::app()->controller->currency; ?> 0.00</div>
            <div class="order-home-form-but">
                <button class="btn btn-gradient js-order-new"><span><?= Yii::t('OtherModule.other', 'Order now'); ?></span></button>
            </div>
        </div>

        <div class="screen-text screen-text--1"><span class="label">Your profile</span><span class="value">Students</span><span class="value">Applicants</span><span class="value">Postgraduate students</span><span class="value">Researchers</span><span class="value">Teachers</span><span class="value">Bloggers</span><span class="value">Copywriters</span><span class="value">Marketers</span></div>
        <div class="screen-text screen-text--2"><span class="label">Your benefits</span><span class="value">Productive</span><span class="value">Stylish</span><span class="value">Neat&fast</span><span class="value">Comfortable</span><span class="value">Convenient</span><span class="value">High-quality</span><span class="value">Reliable</span><span class="value">Professional</span></div>
    </div>
<?php endif; ?>
