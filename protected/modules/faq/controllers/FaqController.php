<?php
class FaqController extends \yupe\components\controllers\FrontController
{

	public function actionView($slug)
    {
        $model = Faq::model();

        $model = ($this->isMultilang())
            ? $model->language(Yii::app()->getLanguage())->find('slug = :slug', [':slug' => $slug])
            : $model->find('slug = :slug', [':slug' => $slug]);

        if (!$model) {
            throw new CHttpException(404, Yii::t('FaqModule.faq', 'Faq article was not found!'));
        }

        $this->render('view', ['model' => $model]);
    }

    /**
     *
     */
    public function actionIndex()
    {
        $model = Faq::model();

        $model = ($this->isMultilang())
            ? $model->language(Yii::app()->getLanguage())->findAll()
            : $model->findAll();

        if (!$model) {
            throw new CHttpException(404, Yii::t('FaqModule.faq', 'Faq article was not found!'));
        }

        $this->render('index', ['model' => $model]);
    }
}