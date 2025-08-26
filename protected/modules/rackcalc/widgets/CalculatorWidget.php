<?php
/**
 *
 */
Yii::import('application.modules.rackcalc.models.*');

class CalculatorWidget extends yupe\widgets\YWidget
{
    public $view = 'calculator-widget';
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $model = new CalculatorForm;
        $json = null;
        $modal = false;
        if (isset($_POST['ProductDoc'])) {
            $modal = true;
        }
        if (isset($_POST['CalculatorForm'])) {
            $model->oldAttributes = $model->attributes; // Сохраняем старые значения атрибутов
            $model->attributes = $_POST['CalculatorForm'];
            if ($model->validate()) {
                if (isset($_POST['button']) && ($_POST['button']=='send' || $_POST['button']=='com')) {

                    $json = CJSON::encode($model->save());

                    if ($_POST['button'] == 'com') {
                        $modal = true;
                        $json = null;
                    }
                    // Yii::app()->controller->refresh();
                }
            }
        }

        $this->render($this->view, [
            'model' => $model,
            'json' => $json,
            'modal' => $modal,
            'product' => $model->getProduct(),
        ]);
    }
}