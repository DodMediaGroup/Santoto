<?php

/**
 * This is the model class for table "grupo_materias".
 *
 * The followings are the available columns in table 'grupo_materias':
 * @property integer $id
 * @property integer $grupo
 * @property integer $materia
 * @property double $nota_maxima
 *
 * The followings are the available model relations:
 * @property AlumnoMaterias[] $alumnoMateriases
 * @property Cortes[] $cortes
 * @property Grupos $grupo0
 * @property Materias $materia0
 */
class GrupoMaterias extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'grupo_materias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grupo, materia, nota_maxima', 'required'),
			array('grupo, materia', 'numerical', 'integerOnly'=>true),
			array('nota_maxima', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, grupo, materia, nota_maxima', 'safe', 'on'=>'search'),
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
			'alumnoMateriases' => array(self::HAS_MANY, 'AlumnoMaterias', 'materia'),
			'cortes' => array(self::HAS_MANY, 'Cortes', 'materia'),
			'grupo0' => array(self::BELONGS_TO, 'Grupos', 'grupo'),
			'materia0' => array(self::BELONGS_TO, 'Materias', 'materia'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'grupo' => 'Grupo',
			'materia' => 'Materia',
			'nota_maxima' => 'Nota Maxima',
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
		$criteria->compare('grupo',$this->grupo);
		$criteria->compare('materia',$this->materia);
		$criteria->compare('nota_maxima',$this->nota_maxima);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GrupoMaterias the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
