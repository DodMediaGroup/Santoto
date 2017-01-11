<?php

/**
 * This is the model class for table "registros".
 *
 * The followings are the available columns in table 'registros':
 * @property integer $id
 * @property integer $meta
 * @property integer $corte
 * @property double $nota_minima
 * @property double $nota_obtenida
 *
 * The followings are the available model relations:
 * @property MetasMateria $meta0
 * @property Cortes $corte0
 */
class Registros extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registros';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('meta, corte, nota_minima', 'required'),
			array('meta, corte', 'numerical', 'integerOnly'=>true),
			array('nota_minima, nota_obtenida', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, meta, corte, nota_minima, nota_obtenida', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'meta0' => array(self::BELONGS_TO, 'MetasMateria', 'meta'),
			'corte0' => array(self::BELONGS_TO, 'Cortes', 'corte'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'meta' => 'Meta',
			'corte' => 'Corte',
			'nota_minima' => 'Nota Minima',
			'nota_obtenida' => 'Nota Obtenida',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('meta',$this->meta);
		$criteria->compare('corte',$this->corte);
		$criteria->compare('nota_minima',$this->nota_minima);
		$criteria->compare('nota_obtenida',$this->nota_obtenida);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Registros the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
