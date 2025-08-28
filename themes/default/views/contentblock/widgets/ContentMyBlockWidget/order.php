<?php if($block): ?>
    <div class="order-home-head">
        <div class="order-home-title title"><?= $block->content; ?></div>
        <div class="order-home-desc desc"><?= $block->content2; ?></div>
    </div>
    <div class="order-home-main">
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

        <div class="screen-text screen-text--1"><?= $block->content3; ?></div>
        <div class="screen-text screen-text--2"><?= $block->content4; ?></div>
    </div>
<?php endif; ?>
