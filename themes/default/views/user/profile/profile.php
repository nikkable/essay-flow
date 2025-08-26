<?php
Yii::import('application.modules.other.OtherModule');
Yii::import('application.modules.rackcalc.models.Subjects');
Yii::import('application.modules.rackcalc.models.Language');

$this->title = Yii::t('UserModule.user', 'User profile');
$this->breadcrumbs = [Yii::t('UserModule.user', 'User profile')];

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id' => 'profile-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
        'type' => 'vertical',
        'htmlOptions' => [
            'class' => 'well',
            'enctype' => 'multipart/form-data'
        ]
    ]
);
?>

<div class="container m-t-5 m-b-5">
    <h1><?= Yii::t('OtherModule.other', 'Profile'); ?></h1>

    <div class="m-b-5">
        <a href="<?= Yii::app()->createUrl('/user/profile/profile') ?>" class="btn btn-primary"><?= Yii::t("OtherModule.other", "Profile"); ?></a>

        <?php if(Yii::app()->user->checkAccess('author')): ?>
            <a href="<?= Yii::app()->createUrl('/order/order/payments') ?>" class="btn btn-secondary"><?= Yii::t("OtherModule.other", "Payments"); ?></a>
            <a href="<?= Yii::app()->createUrl('/user/profile/verify') ?>" class="btn btn-secondary"><?= Yii::t("OtherModule.other", "Verify"); ?></a>
        <?php endif; ?>
    </div>

    <div class="form cart-form">
        <?= $form->errorSummary($model); ?>

        <div class="row">
            <div class="col col-xl-3">
                <div class="form-group">
                    <label for=""><?= Yii::t('OtherModule.other', 'Role'); ?></label>
                    <input type="text" class="form-control field-text" disabled value="<?= Yii::app()->user->checkAccess('author') ? Yii::t('OtherModule.other', 'Author') : Yii::t('OtherModule.other', 'User'); ?>">
                </div>
            </div>
            <div class="col-12 col-md-4 col-xl-3">
                <?= $form->textFieldGroup($model, 'nick_name', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'disabled' => true,
                            'class' => 'field-text',
                        ]
                    ]
                ]) ?>
            </div>
            <div class="col-12 col-md-4 col-xl-3">
                <div class="form-group">
                    <?= $form->textFieldGroup(
                        $user,
                        'email',
                        [
                            'widgetOptions' => [
                                'htmlOptions' => [
                                    'disabled' => true,
                                    'class' => 'field-text',
                                ],
                            ],
                        ]
                    ); ?>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="form-group">
                    <?= $form->numberFieldGroup($model, 'phone', [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'class' => 'field-text',
                            ]
                        ]
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4 col-xl-3">
                <?= $form->textFieldGroup($model, 'street', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'field-text',
                        ]
                    ]
                ]) ?>
            </div>
            <div class="col-12 col-md-4 col-xl-3">
                <?= $form->dropDownListGroup($model, 'country', [
                    'widgetOptions' => [
                        'data' => User::getCountryList(),
                        'htmlOptions' => [
                            'class' => 'field-text',
                        ]
                    ]
                ]) ?>
            </div>
            <div class="col-12 col-md-4 col-xl-3">
                <?= $form->textFieldGroup($model, 'city', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'field-text',
                        ]
                    ]
                ]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4 col-xl-3">
                <?= $form->textFieldGroup($model, 'zipcode', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'field-text',
                        ]
                    ]
                ]) ?>
            </div>
            <div class="col-12 col-md-4 col-xl-3">
                <?= $form->textFieldGroup($model, 'house', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'field-text',
                        ]
                    ]
                ]) ?>
            </div>
        </div>

        <?php if(Yii::app()->user->checkAccess('author')): ?>
            <div class="row">
                <div class="col-12 col-md-6 col-xl-6">
                    <?= $form->dropDownListGroup($model, 'subjects', [
                        'widgetOptions' => [
                            'data' => Subjects::getSubjectsDropdown(),
                            'htmlOptions' => [
                                'class' => 'field-text field-dropdown-group',
                                'multiple' => true,
                                'name' => 'ProfileForm[subjects][]',
                            ]
                        ]
                    ]) ?>

                    <style>
                        .field-dropdown-group {
                            height: 200px;
                        }
                    </style>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-xl-6">
                    <?= $form->dropDownListGroup($model, 'languages', [
                        'widgetOptions' => [
                            'data' => Language::getLanguagesDropdown(),
                            'htmlOptions' => [
                                'class' => 'field-text field-dropdown-group',
                                'multiple' => true,
                                'name' => 'ProfileForm[languages][]',
                            ]
                        ]
                    ]) ?>

                    <style>
                        .field-dropdown-group {
                            height: 200px;
                        }
                    </style>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-xl-6">
                    <?= $form->textAreaGroup($model, 'skills', [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'class' => 'field-textarea',
                                'rows' => 5
                            ]
                        ]
                    ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-xl-6">
                    <?= $form->textFieldGroup($model, 'linked', [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'class' => 'field-text',
                            ]
                        ]
                    ]) ?>
                </div>
                <!--
                <div class="col-12 col-md-4 col-xl-3">
                    <?= $form->textFieldGroup($model, 'file', [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'class' => 'field-text',
                            ]
                        ]
                    ]) ?>
                </div>
                -->
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-xl-6">
                    <div class="form-group">
                        <label>File</label>
                        <div class="file-input-container">
                            <label for="ProfileForm_file" class="file-input-label btn btn-primary"><?= Yii::t('OtherModule.other', 'Upload file'); ?></label>
                            <input class="file-input" type="file" id="ProfileForm_file" name="ProfileForm[file]">
                            <span id="file-name" style="margin-left: 10px;font-size: 11px;"><a href="<?= $user->getFilePath(); ?>"><?= Yii::t('OtherModule.other', 'Loaded file'); ?></a></span>
                        </div>

                        <script>
                            document.getElementById('ProfileForm_file').addEventListener('change', function(e) {
                                var fileName = '';
                                if (this.files && this.files.length > 1) {
                                    // Если разрешена загрузка нескольких файлов
                                    fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                                } else {
                                    // Для одного файла
                                    fileName = e.target.value.split('\\').pop();
                                }

                                if (fileName) {
                                    document.getElementById('file-name').textContent = fileName;
                                } else {
                                    document.getElementById('file-name').textContent = '';
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="m-t-4">
            <?php $this->widget(
                'bootstrap.widgets.TbButton',
                [
                    'buttonType' => 'submit',
                    'context' => 'primary',
                    'label' => Yii::t('OtherModule.other', 'Save profile'),
                ]
            ); ?>
            <a href="<?= Yii::app()->createUrl('/user/profile/password'); ?>" class="btn btn-primary"><?= Yii::t('OtherModule.other', 'Change password'); ?></a>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>


