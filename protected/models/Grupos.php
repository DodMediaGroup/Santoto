<?php

/**
 * This is the model class for table "grupos".
 *
 * The followings are the available columns in table 'grupos':
 * @property integer $id
 * @property integer $periodo
 * @property integer $curso
 *
 * The followings are the available model relations:
 * @property GrupoAlumnos[] $grupoAlumnoses
 * @property GrupoMaterias[] $grupoMateriases
 * @property Cursos $curso0
 * @property Periodos $periodo0
 */
class Grupos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'grupos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('periodo, curso', 'required'),
			array('periodo, curso', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, periodo, curso', 'safe', 'on'=>'search'),
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
			'grupoAlumnoses' => array(self::HAS_MANY, 'GrupoAlumnos', 'grupo'),
			'grupoMateriases' => array(self::HAS_MANY, 'GrupoMaterias', 'grupo'),
			'curso0' => array(self::BELONGS_TO, 'Cursos', 'curso'),
			'periodo0' => array(self::BELONGS_TO, 'Periodos', 'periodo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'periodo' => 'Periodo',
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
		$criteria->compare('periodo',$this->periodo);
		$criteria->compare('curso',$this->curso);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Grupos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
