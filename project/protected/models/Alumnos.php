<?php

/**
 * This is the model class for table "alumnos".
 *
 * The followings are the available columns in table 'alumnos':
 * @property integer $id
 * @property integer $user
 * @property string $username
 * @property string $nombres
 * @property string $apellidos
 * @property string $email
 *
 * The followings are the available model relations:
 * @property Users $user0
 * @property AlumnosGrupo[] $alumnosGrupos
 */
class Alumnos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alumnos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user, username, nombres, apellidos', 'required', 'on' => 'update'),
			array('user', 'numerical', 'integerOnly'=>true),
			array('username, email', 'length', 'max'=>155),
			array('nombres, apellidos', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user, username, nombres, apellidos, email', 'safe', 'on'=>'search'),

            array('username, nombres, apellidos', 'required', 'on' => 'create'),
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
			'user0' => array(self::BELONGS_TO, 'Users', 'user'),
			'alumnosGrupos' => array(self::HAS_MANY, 'AlumnosGrupo', 'alumno'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user' => 'User',
			'username' => 'Username',
			'nombres' => 'Nombres',
			'apellidos' => 'Apellidos',
			'email' => 'Email',
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
		$criteria->compare('user',$this->user);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('nombres',$this->nombres,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CActiveRecord
     */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getGroup(){
	    $group = null;
        $periodo = Periodos::model()->findByAttributes(array('estado'=>1));
        if($periodo != null){
            $groups = Grupos::model()->findAllByAttributes(array('periodo'=>$periodo->id));
            foreach ($groups as $key=>$value){
                $grupActive = GrupoAlumnos::model()->findByAttributes(array('grupo'=>$value->id, 'alumno'=>$this->id));
                if($grupActive != null){
                    $group = $grupActive;
                    break;
                }
            }
        }
	    return $group;
    }
}
