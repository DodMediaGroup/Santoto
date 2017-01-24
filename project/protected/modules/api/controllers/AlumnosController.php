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
                    'current_alumno',
                ),
                'expression'=>'MyMethods::tokenAuthentication()',
            ),
            array('deny',
                'users'=>array('*')
            ),
        );
    }

    public function actionCurrent_alumno(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $alumno = MyMethods::tokenAuthAlumno();
            if($alumno != null){
                $alumnoResponse = array(
                    'id'=>$alumno->id,
                    'username'=>$alumno->username,
                    'nombres'=>$alumno->nombres,
                    'apellidos'=>$alumno->apellidos,
                    'email'=>$alumno->email,
                    'estado'=>$alumno->user0->estado
                );
                $this->JsonResponse($alumnoResponse);
                return;
            }
            $this->JsonResponse(array(), 401);
        }

    }
}