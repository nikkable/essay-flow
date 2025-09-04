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
                    <div class="form-group">
                        <?= $form->labelEx($model, 'subjects'); ?>
                        <?= $form->dropDownList($model, 'subjects', Subjects::getSubjectsDropdown(), [
                            'class' => 'field-text',
                            'multiple' => true,
                            'style' => 'display:none;',
                        ]); ?>

                        <?php $subjectsData = Subjects::getSubjectsDropdown(); $selectedSubjects = (array)$model->subjects; ?>
                        <div id="subjects-multiselect" class="multi-select">
                            <button type="button" class="multi-select-toggle">
                                <span class="multi-select-label"><?= Yii::t('OtherModule.other', 'Select subjects'); ?></span>
                            </button>
                            <div class="multi-select-menu">
                                <!--
                                <div class="multi-select-search">
                                    <input type="text" class="multi-select-search-input" placeholder="<?= Yii::t('OtherModule.other', 'Search'); ?>">
                                </div>
                                <div class="multi-select-actions">
                                    <button type="button" class="multi-select-action" data-action="select-all"><?= Yii::t('OtherModule.other', 'Select all'); ?></button>
                                    <button type="button" class="multi-select-action" data-action="clear"><?= Yii::t('OtherModule.other', 'Clear'); ?></button>
                                </div>
                                -->
                                <div class="multi-select-options">
                                    <?php foreach ($subjectsData as $value => $label): ?>
                                        <?php $checked = in_array((string)$value, array_map('strval', $selectedSubjects), true) ? 'checked' : ''; ?>
                                        <label class="multi-select-option" data-label="<?= CHtml::encode(mb_strtolower($label, 'UTF-8')); ?>">
                                            <input type="checkbox" value="<?= CHtml::encode($value); ?>" <?= $checked; ?>>
                                            <span><?= CHtml::encode($label); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <?= $form->error($model, 'subjects'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-xl-6">
                    <div class="form-group">
                        <?= $form->labelEx($model, 'languages'); ?>
                        <?= $form->dropDownList($model, 'languages', Language::getLanguagesDropdown(), [
                            'class' => 'field-text',
                            'multiple' => true,
                            'style' => 'display:none;',
                        ]); ?>

                        <?php $languagesData = Language::getLanguagesDropdown(); $selectedLangs = (array)$model->languages; ?>
                        <div id="languages-multiselect" class="multi-select">
                            <button type="button" class="multi-select-toggle">
                                <span class="multi-select-label"><?= Yii::t('OtherModule.other', 'Select languages'); ?></span>
                            </button>
                            <div class="multi-select-menu">
                                <!--
                                <div class="multi-select-search">
                                    <input type="text" class="multi-select-search-input" placeholder="<?= Yii::t('OtherModule.other', 'Search'); ?>">
                                </div>
                                <div class="multi-select-actions">
                                    <button type="button" class="multi-select-action" data-action="select-all"><?= Yii::t('OtherModule.other', 'Select all'); ?></button>
                                    <button type="button" class="multi-select-action" data-action="clear"><?= Yii::t('OtherModule.other', 'Clear'); ?></button>
                                </div>
                                -->
                                <div class="multi-select-options">
                                    <?php foreach ($languagesData as $value => $label): ?>
                                        <?php $checked = in_array((string)$value, array_map('strval', $selectedLangs), true) ? 'checked' : ''; ?>
                                        <label class="multi-select-option" data-label="<?= CHtml::encode(mb_strtolower($label, 'UTF-8')); ?>">
                                            <input type="checkbox" value="<?= CHtml::encode($value); ?>" <?= $checked; ?>>
                                            <span><?= CHtml::encode($label); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?= $form->error($model, 'languages'); ?>
                    </div>
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

<script>
    (function(){
        function initMultiCheckboxSelect(containerId, selectId) {
            const container = document.getElementById(containerId);
            const select = document.getElementById(selectId);

            if (!container || !select) return;

            const toggleBtn = container.querySelector('.multi-select-toggle');
            const searchInput = container.querySelector('.multi-select-search-input');
            const optionsWrap = container.querySelector('.multi-select-options');

            function updateLabel() {
                let labels = [];
                Array.prototype.forEach.call(select.selectedOptions || [], function(opt){ labels.push(opt.text); });
                if (!labels.length) {
                    container.querySelector('.multi-select-label').textContent = (selectId.indexOf('subjects') !== -1)
                        ? '<?= Yii::t('OtherModule.other', 'Select subjects'); ?>'
                        : '<?= Yii::t('OtherModule.other', 'Select languages'); ?>';
                } else {
                    container.querySelector('.multi-select-label').textContent = labels.join(', ');
                }
            }

            function syncFromCheckboxes() {
                const checkedValues = Array.prototype.map.call(optionsWrap.querySelectorAll('input[type="checkbox"]:checked'), function(cb){ return cb.value; });
                Array.prototype.forEach.call(select.options, function(opt){ opt.selected = checkedValues.indexOf(opt.value) !== -1; });
                const evt = document.createEvent('HTMLEvents');
                evt.initEvent('change', true, false);
                select.dispatchEvent(evt);
                updateLabel();
            }

            function syncFromSelect() {
                const selectedValues = Array.prototype.map.call(select.selectedOptions || [], function(opt){ return opt.value; });
                Array.prototype.forEach.call(optionsWrap.querySelectorAll('input[type="checkbox"]'), function(cb){ cb.checked = selectedValues.indexOf(cb.value) !== -1; });
                updateLabel();
            }

            // Toggle menu
            toggleBtn.addEventListener('click', function(){
                container.classList.toggle('multi-select--open');
            });

            // Close on outside click
            document.addEventListener('click', function(e){
                if (!container.contains(e.target)) container.classList.remove('multi-select--open');
            });

            // Search filter
            if (searchInput) {
                searchInput.addEventListener('input', function(){
                    const q = this.value.trim().toLowerCase();
                    Array.prototype.forEach.call(container.querySelectorAll('.multi-select-option'), function(opt){
                        const label = opt.getAttribute('data-label') || '';
                        opt.style.display = label.indexOf(q) !== -1 ? '' : 'none';
                    });
                });
            }

            // Actions: select all / clear
            container.querySelectorAll('.multi-select-action').forEach(function(btn){
                btn.addEventListener('click', function(){
                    const action = this.getAttribute('data-action');
                    const cbs = container.querySelectorAll('input[type="checkbox"]');
                    cbs.forEach(function(cb){ cb.checked = (action === 'select-all'); });
                    syncFromCheckboxes();
                });
            });

            optionsWrap.addEventListener('change', function(e){
                if (e.target && e.target.type === 'checkbox') syncFromCheckboxes();
            });

            select.addEventListener('change', syncFromSelect);

            syncFromSelect();
        }

        function findSelectIdLike(base) {
            const candidates = [base, 'ProfileForm_' + base];
            for (let i = 0; i<candidates.length; i++) {
                const el = document.getElementById(candidates[i]);
                if (el) return candidates[i];
            }

            const byName = document.querySelector('select[name="ProfileForm[' + base + '][]"]');
            return byName ? byName.id : null;
        }

        document.addEventListener('DOMContentLoaded', function(){
            const subjectsSelectId = findSelectIdLike('subjects');
            const languagesSelectId = findSelectIdLike('languages');
            if (subjectsSelectId) initMultiCheckboxSelect('subjects-multiselect', subjectsSelectId);
            if (languagesSelectId) initMultiCheckboxSelect('languages-multiselect', languagesSelectId);
        });
    })();
</script>


