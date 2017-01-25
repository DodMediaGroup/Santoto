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
                    'materias',
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
                $grupo = $alumno->getGroup();
                $alumnoResponse = array(
                    'id'=>$alumno->id,
                    'username'=>$alumno->username,
                    'nombres'=>$alumno->nombres,
                    'apellidos'=>$alumno->apellidos,
                    'email'=>$alumno->email,
                    'grupo'=>array(
                        'curso'=>$grupo->grupo0->curso0->nombre,
                        'anio'=>$grupo->grupo0->periodo0->nombre
                    ),
                    'estado'=>$alumno->user0->estado
                );
                $this->JsonResponse($alumnoResponse);
                return;
            }

            $this->JsonResponse(array(), 401);
        }
    }

    public function actionMaterias(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $alumno = MyMethods::tokenAuthAlumno();
            if($alumno != null){
                $grupo = $alumno->getGroup();
                $materias = AlumnoMaterias::model()->findAllByAttributes(array(
                    'alumno'=>$grupo->id
                ));
                $materiasResponse = array();

                foreach ($materias as $key=>$materia){
                    $desc = '';
                    if($materia->meta == 0)
                        $desc = 'Aun no has asignado una meta';
                    else{
                        if(count($materia->materia0->cortes) == count($materia->registroses))
                            $desc = 'Todos los cortes completados.';
                        else
                            $desc = (count($materia->materia0->cortes) - count($materia->registroses)) + 'cortes por asignar.';
                    }

                    $materiaResponse = array(
                        'id'=>$materia->id,
                        'nombre'=>$materia->materia0->materia0->nombre,
                        'meta'=>$materia->meta,
                        'descripcion'=>$desc
                    );
                    $materiasResponse[] = $materiaResponse;
                }


                $this->JsonResponse($materiasResponse);
                return;
            }

            $this->JsonResponse(array(), 401);
        }
    }
}