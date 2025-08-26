<?php
/**
**/
class FaqBackendController extends \yupe\components\controllers\BackController
{

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'inline' => [
                'class' => 'yupe\components\actions\YInLineEditAction',
                'model' => 'Faq',
                'validAttributes' => ['title', 'slug', 'date', 'status'],
            ],
            'sortable' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'Faq',
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
        $model = new Faq();

        if (($data = Yii::app()->getRequest()->getPost('Faq')) !== null) {

            $model->setAttributes($data);
            if ($model->save()) {     
                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('FaqModule.faq', 'Faq added')
                );

                $this->redirect(
                    (array)Yii::app()->getRequest()->getPost(
                        'submit-type',
                        ['create']
                    )
                );
            }
        }

        $languages = $this->yupe->getLanguagesList();

        //если добавляем перевод
        $id = (int)Yii::app()->getRequest()->getQuery('id');
        $lang = Yii::app()->getRequest()->getQuery('lang');

        if (!empty($id) && !empty($lang)) {
            $stocks = Faq::model()->findByPk($id);

            if (null === $stocks) {
                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::ERROR_MESSAGE,
                    Yii::t('FaqModule.faq', 'Targeting news was not found!')
                );

                $this->redirect(['/faq/faqBackend/create']);
            }

            if (!array_key_exists($lang, $languages)) {
                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::ERROR_MESSAGE,
                    Yii::t('FaqModule.faq', 'Language was not found!')
                );

                $this->redirect(['/faq/faqBackend/create']);
            }

            Yii::app()->getUser()->setFlash(
                yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                Yii::t(
                    'FaqModule.faq',
                    'You inserting translation for {lang} language',
                    [
                        '{lang}' => $languages[$lang],
                    ]
                )
            );

            $model->setAttributes([
                'lang' => $lang,
                'slug' => $stocks->slug,
                'date' => $stocks->date,
                'title' => $stocks->title,
                'position' => $stocks->position,
            ]);
        } else {
            $model->setAttributes([
                'date' => date('d-m-Y'),
                'lang' => Yii::app()->getLanguage(),
            ]);
        }

        $this->render('create', ['model' => $model, 'languages' => $languages]);
    }
    /**
     * @param $id
     * @throws CHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (($data = Yii::app()->getRequest()->getPost('Faq')) !== null) {

            $model->setAttributes($data);
            if ($model->save()) {
                
                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('FaqModule.faq', 'Faq added')
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

        // найти по slug страницы на других языках
        $langModels = Faq::model()->findAll(
            'slug = :slug AND id != :id',
            [
                ':slug' => $model->slug,
                ':id' => $model->id,
            ]
        );

        $this->render(
            'update',
            [
                'langModels' => CHtml::listData($langModels, 'lang', 'id'),
                'model' => $model,
                'languages' => $this->yupe->getLanguagesList(),
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
                Yii::t('FaqModule.faq', 'Record was removed!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            Yii::app()->getRequest()->getParam('ajax') !== null || $this->redirect(
                (array)Yii::app()->getRequest()->getPost('returnUrl', 'index')
            );
        } else {
            throw new CHttpException(
                400,
                Yii::t('FaqModule.faq', 'Bad raquest. Please don\'t use similar requests anymore!')
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
        $model = new Faq('search');
        $model->unsetAttributes(); // clear any default values

        $model->setAttributes(
            Yii::app()->getRequest()->getParam(
                'Faq',
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
        if (($model = Faq::model()->findByPk($id)) === null) {
            throw new CHttpException(
                404,
                Yii::t('FaqModule.faq', 'Requested page was not found!')
            );
        }

        return $model;
    }
}
