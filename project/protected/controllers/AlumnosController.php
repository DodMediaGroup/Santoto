<?php

class AlumnosController extends Controller {

    /**
     * @return array action filters
     */
    public function filters(){
        return array(
            'accessControl',
            'postOnly + delete'
        );
    }

    public function accessRules(){
        return array(
            array('allow',
                'actions'=>array(
                    'admin',
                    'create'
                ),
                'users'=>array('@'),
                'expression'=>'MyMethods::isAdmin()',
            ),
            array('deny',
                'users'=>array('*')
            ),
        );
    }

    public function actionAdmin(){
        $alumnos = Alumnos::model()->findAll();
        $this->render('admin', array(
            'alumnos'=>$alumnos
        ));
    }

    public function actionCreate(){
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile(Yii::app()->baseUrl.'/js/modules/alumnos.js', CClientScript::POS_END);

        $model = new Alumnos;

        if(isset($_POST['Alumnos']) && isset($_POST['Alumnos']['password'])){
            $model->setScenario('create');
            $model->attributes = $_POST['Alumnos'];
            if($model->validate(null, true)){
                $usernameExist = Alumnos::model()->findByAttributes(array(
                    'username'=>$model->username
                ));
                if($usernameExist == null){
                    $modelUser = new Users;
                    $modelUser->password = MyMethods::crypt_blowfish($_POST['Alumnos']['password']);
                    if($modelUser->save()){
                        $model->user = $modelUser->id;
                        $model->save();
                        $this->redirect(array('admin'));
                    }
                }
                else
                    $model->addError('username', 'El username ingresado ya se encuentra en uso.');
            }
        }

        $this->render('create', array(
            'model'=>$model
        ));
    }
}