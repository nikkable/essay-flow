<?php

class LanguageBackendController extends \yupe\components\controllers\BackController
{
    public function actions()
    {
        return [
            'inline' => [
                'class' => 'yupe\components\actions\YInLineEditAction',
                'model' => 'Language',
                'validAttributes' => ['name', 'cost'],
            ]
        ];
    }

    /**
     * View
     *
     * @param integer $id
     *
     * @return void
     */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }

    /**
     *
     * @return void
     */
    public function actionCreate()
    {
        $model = new Language;

        if (Yii::app()->getRequest()->getPost('Language') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('Language'));

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('RackcalcModule.rackcalc', 'Запись добавлена!')
                );

//                $this->redirect(
//                    (array)Yii::app()->getRequest()->getPost(
//                        'submit-type',
//                        [
//                            'update',
//                            'id' => $model->id
//                        ]
//                    )
//                );
            }
        }

        $this->render('create', [
            'model' => $model,
            'languages' => $this->yupe->getLanguagesList()
        ]);
    }

    /**
     * @param integer $id
     *
     * @return void
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getPost('Language') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('Language'));

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('RackcalcModule.rackcalc', 'Запись обновлена!')
                );

                $this->redirect(
                    (array)Yii::app()->getRequest()->getPost(
                        'submit-type',
                        [
                            'update',
                            'id' => $model->id
                        ]
                    )
                );
            }
        }
        $this->render('update', [
            'model' => $model,
            'languages' => $this->yupe->getLanguagesList()
        ]);
    }

    /**
     *
     * @param integer $id
     *
     * @return void
     */
    public function actionDelete($id)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            // поддерживаем удаление только из POST-запроса
            $this->loadModel($id)->delete();

            Yii::app()->user->setFlash(
                yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                Yii::t('RackcalcModule.rackcalc', 'The entry has been deleted!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(Yii::app()->getRequest()->getPost('returnUrl', ['index']));
            }
        } else
            throw new CHttpException(400, Yii::t('RackcalcModule.rackcalc', 'Invalid request. Please do not make such requests again.'));
    }

    /**
     *
     * @return void
     */
    public function actionIndex()
    {
        $model = new Language('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('Language') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('Language'));
        $this->render('index', [
            'model' => $model,
            'batchModel' => new RackcalcBatchForm()
        ]);
    }

    /**
     *
     * @param integer идентификатор нужной модели
     *
     * @return void
     */
    public function loadModel($id)
    {
        $model = Language::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('RackcalcModule.rackcalc', 'Запрошенная страница не найдена.'));

        return $model;
    }

    /**
     *
     */
    public function actionBatch()
    {
        $form = new RackcalcBatchForm();
        $form->setAttributes(Yii::app()->getRequest()->getPost('RackcalcBatchForm'));

        if ($form->validate() === false) {
            Yii::app()->ajax->failure(Yii::t('StoreModule.store', 'Wrong data'));
        }

        if ($this->rackcalcRepository->batchUpdate($form, Words::model())) {
            $this->redirect(['index']);
            Yii::app()->ajax->success('ok');
        }

        Yii::app()->ajax->failure();
    }
}
