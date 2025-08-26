<div class="question-items">
    <?php foreach ($model as $key => $item): ?>
        <div class="question-item js-faq-item <?= $key === 0 ? 'show' : ''; ?>">
            <div class="question-item-head">
                <div class="question-item-title"><?= $item->title; ?></div>
                <div class="question-item-icon">
                    <?= file_get_contents(Yii::app()->theme->basePath . '/web/images/plus.svg') ?>
                </div>
            </div>
            <div class="question-item-main">
                <div class="question-item-desc"><?= $item->full_text; ?></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
