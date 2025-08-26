<?php
/**
 *
 **/
Yii::import('application.modules.contentblock.models.ContentBlock');
Yii::import('application.modules.contentblock.ContentBlockModule');

/**
 * Class ContentBlockWidget
 */
class ContentMyBlockWidget extends yupe\widgets\YWidget
{
    /**
     * @var
     */
    public $id;
    public $class;
    public $code;
    /**
     * @var string
     */
    public $view = 'contentblock';

    /**
     * @throws CException
     */
    public function run()
    {
        $block = ContentBlock::model()->find([
            'condition' => 'code = :code AND (lang = :lang OR (lang = :deflang))',
            'params' => [
                ':code' => $this->code,
                ':lang' => Yii::app()->getLanguage(),
                ':deflang' => Yii::app()->getModule('yupe')->defaultLanguage,
            ],
            'order' => 'FIELD(lang, "' . Yii::app()->getLanguage() . '", "' . Yii::app()->getModule('yupe')->defaultLanguage . '")'
        ]);

        $this->render($this->view, [
            'block' => $block,
            'class' => $this->class,
        ]);
    }
}
