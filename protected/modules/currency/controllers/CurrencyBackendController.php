<?php
/**
**/
class CurrencyBackendController extends \yupe\components\controllers\BackController
{

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'inline' => [
                'class' => 'yupe\components\actions\YInLineEditAction',
                'model' => 'Currency',
                'validAttributes' => ['name', 'slug', 'status', 'coff'],
            ],
            'sortable' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'Currency',
                'attribute' => 'position',
            ],
        ];
    }

    /**
    * Отображает акцию по указанному идентификатору
    *
    * @param integer $id Идинтификатор акции для отображения
    *
    * @return void
    */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return void
     */
    public function actionCreate()
    {
        $model = new Currency();

        if (($data = Yii::app()->getRequest()->getPost('Currency')) !== null) {

            $model->setAttributes($data);
            if ($model->save()) {     
                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('CurrencyModule.currency', 'Add currency done')
                );

                $this->redirect(
                    (array)Yii::app()->getRequest()->getPost(
                        'submit-type',
                        ['create']
                    )
                );
            }
        }

        $this->render('create', ['model' => $model]);
    }
    /**
     * @param $id
     * @throws CHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (($data = Yii::app()->getRequest()->getPost('Currency')) !== null) {

            $model->setAttributes($data);
            if ($model->save()) {
                
                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('CurrencyModule.currency', 'Currency add done')
                );

                $this->redirect(
                    Yii::app()->getRequest()->getIsPostRequest()
                        ? (array)Yii::app()->getRequest()->getPost(
                        'submit-type',
                        ['update', 'id' => $model->id]
                    )
                        : ['view', 'id' => $model->id]
                );
            }
        }

        $this->render(
            'update',
            [
                'model' => $model,
            ]
        );
    }
    
    /**
     * @param null $id
     * @throws CHttpException
     */
    public function actionDelete($id = null)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {

            $this->loadModel($id)->delete();

            Yii::app()->getUser()->setFlash(
                yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                Yii::t('CurrencyModule.currency', 'Record was removed!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            Yii::app()->getRequest()->getParam('ajax') !== null || $this->redirect(
                (array)Yii::app()->getRequest()->getPost('returnUrl', 'index')
            );
        } else {
            throw new CHttpException(
                400,
                Yii::t('CurrencyModule.currency', 'Bad raquest. Please don\'t use similar requests anymore!')
            );
        }
    }
    
    /**
     * Manages all models.
     *
     * @return void
     */
    public function actionIndex()
    {
        $model = new Currency('search');
        $model->unsetAttributes(); // clear any default values

        $model->setAttributes(
            Yii::app()->getRequest()->getParam(
                'Currency',
                []
            )
        );

        $this->render('index', ['model' => $model]);
    }
    
    /**
     * @param $id
     * @return static
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        if (($model = Currency::model()->findByPk($id)) === null) {
            throw new CHttpException(
                404,
                Yii::t('CurrencyModule.currency', 'Requested page was not found!')
            );
        }

        return $model;
    }
}
