<?php
Yii::import('application.modules.faq.models.*');

class FaqWidget extends yupe\widgets\YWidget
{
    public $view = 'faq';

    public function run()
    {
        // Step 1: Создаем критерий для подзапроса
        // Мы находим ID последней записи для каждого уникального slug
        // Это обходит ошибку ONLY_FULL_GROUP_BY
        $subCriteria = new CDbCriteria();
        $subCriteria->select = 'MAX(t.id)';
        $subCriteria->group = 't.slug';
        $subCriteria->condition = 't.lang = :lang';
        $subCriteria->params = [':lang' => Yii::app()->getLanguage()];

        // Получаем массив ID, которые соответствуют нужным нам записям
        // createCommand() - это более прямой способ выполнения запроса в Yii 1.x
        $command = Yii::app()->db->createCommand()
            ->select('MAX(id)')
            ->from('{{faq}}')
            ->where('lang = :lang', [':lang' => Yii::app()->getLanguage()])
            ->group('slug');

        $ids = $command->queryColumn();

        // Step 2: Создаем основной критерий для выборки полных моделей
        $criteria = new CDbCriteria();
        // Используем `addInCondition` для выбора всех моделей, ID которых есть в нашем массиве
        $criteria->addInCondition('id', $ids);

        // Применяем лимит и сортировку, как в вашем первоначальном запросе
        $criteria->limit = (int)$this->limit;
        $criteria->order = 'FIELD(lang, "' . Yii::app()->getLanguage() . '", "' . Yii::app()->getModule('yupe')->defaultLanguage . '") ASC, date DESC';

        // Выбираем модели по новым критериям
        $model = Faq::model()->findAll($criteria);

        $this->render($this->view, ['model' => $model]);
    }
}