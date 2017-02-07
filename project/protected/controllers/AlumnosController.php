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
                    'create',
                    'update',

                    'getList',
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

    public function actionUpdate($id){
        $model = $this->loadAlumno($id);

        if(isset($_POST['Alumnos'])){
            $model->setScenario('update');
            $model->attributes = $_POST['Alumnos'];
            if($model->validate(null, true)){
                $usernameExist = Alumnos::model()->findByAttributes(array(
                    'username'=>$model->username
                ), array(
                    'condition'=>'t.id != '.$model->id
                ));
                if($usernameExist == null){
                    $model->save();

                    if(isset($_POST['Alumnos']['password'])){
                        $modelUser = $model->user0;
                        $modelUser->password = MyMethods::crypt_blowfish($_POST['Alumnos']['password']);
                        $modelUser->save();
                    }

                    $this->redirect(array('admin'));
                }
                else
                    $model->addError('username', 'El username ingresado ya se encuentra en uso.');
            }
        }

        $this->render('update', array(
            'model'=>$model
        ));
    }

    public function actionGetList(){
        if(Yii::app()->request->isAjaxRequest && isset($_GET['username'])){
            $username = (isset($_GET['username']))?trim($_GET['username']):'';
            $alumnos = array();

            if($username != ''){
                $dbAlumnos = Alumnos::model()->findAll(array(
                    'condition'=>'t.username like "%'.$username.'%"',
                    'order'=>'t.apellidos ASC'
                ));
                foreach ($dbAlumnos as $key=>$alumno){
                    if($alumno->user0->estado == 1){
                        $group = $alumno->getGroup();
                        $alumnos[] = array(
                            'id'=>$alumno->id,
                            'username'=>$alumno->username,
                            'nombres'=>$alumno->nombres,
                            'apellidos'=>$alumno->apellidos,
                            'email'=>$alumno->email,
                            'grupo'=>($group != null)?$group->id:''
                        );
                    }
                }
            }

            echo CJSON::encode($alumnos);
        }
        else
            throw new CHttpException(404, 'The requested page does not exist');
    }

    private function loadAlumno($id){
        $alumno = Alumnos::model()->findByAttributes(array(
            'id'=>$id,
        ));
        if($alumno == null)
            throw new CHttpException(404, 'The requested page does not exist');

        return $alumno;
    }
}