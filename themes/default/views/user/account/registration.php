<?php
Yii::import('application.modules.other.OtherModule');

$this->title = Yii::t('OtherModule.other', 'Register');
$this->breadcrumbs = [Yii::t('OtherModule.other', 'Register')];
?>

<script type='text/javascript'>
    $(document).ready(function () {
        function str_rand(minlength) {
            var result = '';
            var words = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
            var max_position = words.length - 1;
            for (i = 0; i < minlength; ++i) {
                position = Math.floor(Math.random() * max_position);
                result = result + words.substring(position, position + 1);
            }
            return result;
        }

        $('#generate_password').click(function (event) {
            event.preventDefault()

            var pass = str_rand($(this).data('minlength'));
            $('#RegistrationForm_password').attr('type', 'text');
            $('#RegistrationForm_password').val(pass);
            $('#RegistrationForm_cPassword').val(pass);
        });
    })
</script>

<?php $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id' => 'registration-form',
        'type' => 'vertical',
        'htmlOptions' => [
            'class' => 'well',
        ]
    ]
); ?>

<div class="auth">
    <div class="auth-main">
        <div class="auth-box">
            <a href="/" class="auth-box-back">
                <?= file_get_contents(Yii::app()->theme->basePath . '/web/images/arrow-prev.svg') ?>
                <?= Yii::t('OtherModule.other', 'Back') ?>
            </a>
            <div class="auth-box-title title"><?= Yii::t('OtherModule.other', 'Register') ?></div>
            <div class="auth-box-form">
                <?php $this->widget('yupe\widgets\YFlashMessages'); ?>

                <?= $form->errorSummary($model); ?>

                <div class="form-group">
                    <?php if (!$this->module->generateNickName) : ?>
                        <?= $form->textField($model, 'nick_name', [ 'class' => 'field-text', 'placeholder' => Yii::t('OtherModule.other', 'User name') ]); ?>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <?= $form->textField($model, 'email', [ 'class' => 'field-text', 'placeholder' => Yii::t('OtherModule.other', 'Email') ]); ?>
                </div>
                <div class="form-group">
                    <?= $form->passwordField($model, 'password', [ 'class' => 'field-text', 'placeholder' => Yii::t('OtherModule.other', 'Password') ]); ?>
                </div>
                <div class="form-group">
                    <?= $form->passwordField($model, 'cPassword', [ 'class' => 'field-text', 'placeholder' => Yii::t('OtherModule.other', 'Repeat password') ]); ?>
                </div>

                <?= $form->hiddenField($model, 'verify'); ?>
                <div class="form-captcha">
                    <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>"></div>
                    <?= $form->error($model, 'verifyCode');?>
                </div>
                <br>

                <div class="form-group d-flex flex-gap-3">
                    <?= $form->checkBox($model, 'terms'); ?>
                    <label for="RegistrationForm_terms">
                        <?= Yii::t('OtherModule.other', "I confirm my acceptance of") ?>
                        <a href="<?= Yii::app()->createUrl('/page/page/view', ['slug' => 'terms-and-conditions']); ?>"><?= Yii::t('OtherModule.other', 'Terms And Conditions'); ?></a>
                        <?= Yii::t('OtherModule.other', "and") ?>
                        <a href="<?= Yii::app()->createUrl('/page/page/view', ['slug' => 'privacy-policy']); ?>"><?= Yii::t('OtherModule.other', 'Privacy Policy'); ?></a>
                    </label>
                </div>

                <p><a href="#" id="generate_password" data-minlength="<?= $this->module->minPasswordLength; ?>"><?= Yii::t('OtherModule.other', 'Generate password') ?></a></p>
                <p><?= CHtml::link(Yii::t('OtherModule.other', 'Login'), ['/user/account/login']) ?></p>

                <br>
            </div>
            <div class="auth-box-btns">
                <!--
                <?php if ($module->showCaptcha && CCaptcha::checkRequirements()): { ?>
                    <div class="row">
                        <div class="col-xs-4">
                            <?= $form->textFieldGroup(
                                $model,
                                'verifyCode',
                                ['hint' => Yii::t('OtherModule.other', 'Please enter the text from the image')]
                            ); ?>
                        </div>
                        <div class="col-xs-4">
                            <?php $this->widget(
                                'CCaptcha',
                                [
                                    'showRefreshButton' => true,
                                    'imageOptions' => [
                                        'width' => '150',
                                    ],
                                    'buttonOptions' => [
                                        'class' => 'btn btn-default',
                                    ],
                                    'buttonLabel' => '<i class="glyphicon glyphicon-repeat"></i>',
                                ]
                            ); ?>
                        </div>
                    </div>
                <?php } endif; ?>
                -->

                <button type="submit" class="btn btn-primary"><?= Yii::t('OtherModule.other', 'Register') ?></button>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>
<!-- form -->
