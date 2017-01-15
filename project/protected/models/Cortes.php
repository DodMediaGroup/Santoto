<?php

/**
 * This is the model class for table "cortes".
 *
 * The followings are the available columns in table 'cortes':
 * @property integer $id
 * @property integer $materia
 * @property string $nombre
 * @property double $porcentaje
 *
 * The followings are the available model relations:
 * @property GrupoMaterias $materia0
 * @property Registros[] $registroses
 */
class Cortes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cortes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('materia', 'required'),
			array('materia', 'numerical', 'integerOnly'=>true),
			array('porcentaje', 'numerical'),
			array('nombre', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, materia, nombre, porcentaje', 'safe', 'on'=>'search'),
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
			'materia0' => array(self::BELONGS_TO, 'GrupoMaterias', 'materia'),
			'registroses' => array(self::HAS_MANY, 'Registros', 'corte'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'materia' => 'Materia',
			'nombre' => 'Nombre',
			'porcentaje' => 'Porcentaje',
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
		$criteria->compare('materia',$this->materia);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('porcentaje',$this->porcentaje);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cortes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
