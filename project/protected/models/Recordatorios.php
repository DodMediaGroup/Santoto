<?php

/**
 * This is the model class for table "recordatorios".
 *
 * The followings are the available columns in table 'recordatorios':
 * @property integer $id
 * @property string $titulo
 * @property string $descripcion
 * @property string $fecha_recordatorio
 * @property integer $materia
 * @property string $fecha_agregada
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property AlumnoMaterias $materia0
 */
class Recordatorios extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'recordatorios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titulo, fecha_recordatorio, materia', 'required'),
			array('materia, estado', 'numerical', 'integerOnly'=>true),
			array('titulo', 'length', 'max'=>155),
			array('descripcion, fecha_agregada', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, titulo, descripcion, fecha_recordatorio, materia, fecha_agregada, estado', 'safe', 'on'=>'search'),
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
			'materia0' => array(self::BELONGS_TO, 'AlumnoMaterias', 'materia'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'titulo' => 'Titulo',
			'descripcion' => 'Descripcion',
			'fecha_recordatorio' => 'Fecha Recordatorio',
			'materia' => 'Materia',
			'fecha_agregada' => 'Fecha Agregada',
			'estado' => 'Estado',
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
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('fecha_recordatorio',$this->fecha_recordatorio,true);
		$criteria->compare('materia',$this->materia);
		$criteria->compare('fecha_agregada',$this->fecha_agregada,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Recordatorios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
