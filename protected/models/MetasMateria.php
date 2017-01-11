<?php

/**
 * This is the model class for table "metas_materia".
 *
 * The followings are the available columns in table 'metas_materia':
 * @property integer $id
 * @property integer $alumno
 * @property integer $materia
 * @property double $nota
 *
 * The followings are the available model relations:
 * @property AlumnosGrupo $alumno0
 * @property MateriasCurso $materia0
 * @property Registros[] $registroses
 */
class MetasMateria extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'metas_materia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alumno, materia, nota', 'required'),
			array('alumno, materia', 'numerical', 'integerOnly'=>true),
			array('nota', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, alumno, materia, nota', 'safe', 'on'=>'search'),
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
			'alumno0' => array(self::BELONGS_TO, 'AlumnosGrupo', 'alumno'),
			'materia0' => array(self::BELONGS_TO, 'MateriasCurso', 'materia'),
			'registroses' => array(self::HAS_MANY, 'Registros', 'meta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'alumno' => 'Alumno',
			'materia' => 'Materia',
			'nota' => 'Nota',
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
		$criteria->compare('alumno',$this->alumno);
		$criteria->compare('materia',$this->materia);
		$criteria->compare('nota',$this->nota);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MetasMateria the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
