<?php
class WordsBackendController extends \yupe\components\controllers\BackController
{
    public function actions()
    {
        return [
            'inline' => [
                'class'           => 'yupe\components\actions\YInLineEditAction',
                'model'           => 'Words',
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
        $model = new Words;

//        for ($i = 90; $i <=255 ; $i++) {
//            $model = new Words;
//            $model->name = $i;
//            $model->cost = 10;
//            $model->save();
//        }
//
//        die;

        if (Yii::app()->getRequest()->getPost('Words') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('Words'));

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

        if (Yii::app()->getRequest()->getPost('Words') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('Words'));

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
                Yii::t('RackcalcModule.rackcalc', 'Запись удалена!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(Yii::app()->getRequest()->getPost('returnUrl', ['index']));
            }
        } else
            throw new CHttpException(400, Yii::t('RackcalcModule.rackcalc', 'Неверный запрос. Пожалуйста, больше не повторяйте такие запросы'));
    }

    /**
    *
    * @return void
    */
    public function actionIndex()
    {
        $model = new Words('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('Words') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('Words'));
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
        $model = Words::model()->findByPk($id);
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
