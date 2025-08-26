<?php
Yii::import('zii.widgets.CMenu');
/**
 * FtListView
 */
class MyCMenu extends CMenu
{
    protected function renderMenu($items)
    {
        if(count($items))
        {
            echo CHtml::openTag('ul',$this->htmlOptions)."\n";
            $this->renderMenuRecursive($items);
            echo CHtml::closeTag('ul');
        }
    }

    protected function renderMenuItem($item)
    {
        if(isset($item['url']))
        {
            $label=$this->linkLabelWrapper===null ? $item['label'] : CHtml::tag($this->linkLabelWrapper, $this->linkLabelWrapperHtmlOptions, $item['label']);
            return CHtml::link('<span>' . $label . '</span>',$item['url'],isset($item['linkOptions']) ? $item['linkOptions'] : array());
        }
        else
            return CHtml::tag('span',isset($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
    }
}
