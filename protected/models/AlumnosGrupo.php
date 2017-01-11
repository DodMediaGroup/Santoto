<?php

/**
 * This is the model class for table "alumnos_grupo".
 *
 * The followings are the available columns in table 'alumnos_grupo':
 * @property integer $id
 * @property integer $grupo
 * @property integer $alumno
 *
 * The followings are the available model relations:
 * @property Grupos $grupo0
 * @property Alumnos $alumno0
 * @property MetasMateria[] $metasMaterias
 */
class AlumnosGrupo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alumnos_grupo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grupo, alumno', 'required'),
			array('grupo, alumno', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, grupo, alumno', 'safe', 'on'=>'search'),
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
			'grupo0' => array(self::BELONGS_TO, 'Grupos', 'grupo'),
			'alumno0' => array(self::BELONGS_TO, 'Alumnos', 'alumno'),
			'metasMaterias' => array(self::HAS_MANY, 'MetasMateria', 'alumno'),
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
			'alumno' => 'Alumno',
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
		$criteria->compare('alumno',$this->alumno);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AlumnosGrupo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
