<?php

/**
 * This is the model class for table "materias_curso".
 *
 * The followings are the available columns in table 'materias_curso':
 * @property integer $id
 * @property integer $materia
 * @property integer $curso
 *
 * The followings are the available model relations:
 * @property Cortes[] $cortes
 * @property Materias $materia0
 * @property Grupos $curso0
 * @property MetasMateria[] $metasMaterias
 */
class MateriasCurso extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'materias_curso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('materia, curso', 'required'),
			array('materia, curso', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, materia, curso', 'safe', 'on'=>'search'),
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
			'cortes' => array(self::HAS_MANY, 'Cortes', 'materia'),
			'materia0' => array(self::BELONGS_TO, 'Materias', 'materia'),
			'curso0' => array(self::BELONGS_TO, 'Grupos', 'curso'),
			'metasMaterias' => array(self::HAS_MANY, 'MetasMateria', 'materia'),
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
			'curso' => 'Curso',
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
		$criteria->compare('curso',$this->curso);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MateriasCurso the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
