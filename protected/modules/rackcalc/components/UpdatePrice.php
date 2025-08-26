<?php

class UpdatePrice extends yupe\models\YModel
{
	public $file;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['file', 'required'],
			['file', 'file', 'types' => 'xlsx', 'maxSize' => 1048576],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'file' => 'Файл Exel',
		];
	}
}
