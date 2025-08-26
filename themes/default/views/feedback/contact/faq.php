<?php $this->title = Yii::t('FeedbackModule.feedback', 'FAQ'); ?>

<?php
$this->breadcrumbs = [
    Yii::t('FeedbackModule.feedback', 'Contacts') => ['/feedback/contact/index'],
    Yii::t('FeedbackModule.feedback', 'FAQ'),
];
?>

<div class="question" id="faq">
    <div class="container">
        <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'questions', 'view' => 'question']); ?>
    </div>
</div>
