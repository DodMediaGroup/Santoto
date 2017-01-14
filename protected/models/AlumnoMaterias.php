<?php

/**
 * This is the model class for table "alumno_materias".
 *
 * The followings are the available columns in table 'alumno_materias':
 * @property integer $id
 * @property double $meta
 * @property integer $alumno
 * @property integer $materia
 *
 * The followings are the available model relations:
 * @property GrupoAlumnos $alumno0
 * @property GrupoMaterias $materia0
 * @property Registros[] $registroses
 */
class AlumnoMaterias extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alumno_materias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alumno, materia', 'required'),
			array('alumno, materia', 'numerical', 'integerOnly'=>true),
			array('meta', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, meta, alumno, materia', 'safe', 'on'=>'search'),
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
			'alumno0' => array(self::BELONGS_TO, 'GrupoAlumnos', 'alumno'),
			'materia0' => array(self::BELONGS_TO, 'GrupoMaterias', 'materia'),
			'registroses' => array(self::HAS_MANY, 'Registros', 'materia'),
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
			'alumno' => 'Alumno',
			'materia' => 'Materia',
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
		$criteria->compare('alumno',$this->alumno);
		$criteria->compare('materia',$this->materia);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AlumnoMaterias the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
