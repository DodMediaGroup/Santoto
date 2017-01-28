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
                    'materias', 'materia',
                    'asignar_meta',
                    'nota_corte',
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
                    $completado = false;
                    if($materia->meta == 0)
                        $desc = 'Aun no has asignado una meta';
                    else{
                        if(count($materia->materia0->cortes) == count($materia->registroses)){
                            $completado = true;
                            $desc = 'Todos los cortes completados.';
                        }
                        else
                            $desc = (count($materia->materia0->cortes) - count($materia->registroses)) . ' cortes por asignar.';
                    }

                    $materiaResponse = array(
                        'id'=>$materia->id,
                        'nombre'=>$materia->materia0->materia0->nombre,
                        'meta'=>floatval($materia->meta),
                        'descripcion'=>$desc,
                        'completado'=>$completado
                    );
                    $materiasResponse[] = $materiaResponse;
                }


                $this->JsonResponse($materiasResponse);
                return;
            }

            $this->JsonResponse(array(), 401);
        }
    }

    public function actionMateria($id){
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $alumno = MyMethods::tokenAuthAlumno();
            if ($alumno != null) {
                $grupo = $alumno->getGroup();
                $materia = AlumnoMaterias::model()->findByAttributes(array('id'=>$id, 'alumno'=>$grupo->id));
                if($materia != null){
                    $this->JsonResponse($this->getMateriaJsonInfo($materia));
                    return;
                }
            }

            $this->JsonResponse(array(), 401);
        }
    }

    public function actionAsignar_meta($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $alumno = MyMethods::tokenAuthAlumno();
            if ($alumno != null) {
                $grupo = $alumno->getGroup();
                $materia = AlumnoMaterias::model()->findByAttributes(array('id'=>$id, 'alumno'=>$grupo->id));
                if($materia != null){
                    $requestData = json_decode(file_get_contents("php://input"));
                    if(isset($requestData->meta)){
                        if($requestData->meta >= 0 && $requestData->meta <= $materia->materia0->nota_maxima){
                            $materia->meta = $requestData->meta;
                            $materia->save();

                            $this->JsonResponse(array());
                            return;
                        }
                    }
                }

                $this->JsonResponse(array(), 400);
                return;
            }

            $this->JsonResponse(array(), 401);
        }
    }

    public function actionNota_corte($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $alumno = MyMethods::tokenAuthAlumno();
            if ($alumno != null) {
                $grupo = $alumno->getGroup();
                $materia = AlumnoMaterias::model()->findByAttributes(array('id'=>$id, 'alumno'=>$grupo->id));
                if($materia != null){
                    $requestData = json_decode(file_get_contents("php://input"));
                    if(isset($requestData->corte) && isset($requestData->nota)){
                        $corte = Cortes::model()->findByAttributes(array(
                            'id'=>$requestData->corte,
                            'materia'=>$materia->materia
                        ));
                        if($corte != null && $requestData->nota >= 0 && $requestData->nota <= $materia->materia0->nota_maxima){
                            $registro = Registros::model()->findByAttributes(array(
                                'materia'=>$materia->id,
                                'corte'=>$corte->id
                            ));
                            if($registro == null){
                                $registro = new Registros;
                                $registro->materia = $materia->id;
                                $registro->corte = $corte->id;
                            }
                            $registro->nota = $requestData->nota;
                            $registro->save();

                            $this->JsonResponse($this->getMateriaJsonInfo($materia));
                            return;
                        }
                    }
                }

                $this->JsonResponse(array(), 400);
                return;
            }

            $this->JsonResponse(array(), 401);
        }
    }

    private function getMateriaJsonInfo($materia){
        if($materia != null){
            $cortes = $materia->materia0->cortes;
            $cortesResponse = array();
            $cortesCompletados = 0;
            $completado = false;
            $nota_final = 0;
            foreach ($cortes as $key=>$corte){
                $registro = Registros::model()->findByAttributes(array(
                    'corte'=>$corte->id,
                    'materia'=>$materia->id
                ));
                $registroResponse = null;
                if($registro != null){
                    $registroResponse = array(
                        'nota'=>floatval($registro->nota)
                    );

                    $nota_final += $registro->nota * $corte->porcentaje / 100;
                    $cortesCompletados++;
                }
                $corteResponse = array(
                    'id'=>$corte->id,
                    'nombre'=>$corte->nombre,
                    'porcentaje'=>floatval($corte->porcentaje),
                    'registro'=>$registroResponse
                );
                $cortesResponse[] = $corteResponse;
            }

            if($cortesCompletados >= count($cortes)){
                $completado = true;
            }

            $materiaResponse = array(
                'id'=>$materia->id,
                'meta'=>floatval($materia->meta),
                'materia'=>array(
                    'nombre'=>$materia->materia0->materia0->nombre,
                    'nota_maxima'=>floatval($materia->materia0->nota_maxima),
                ),
                'cortes'=>$cortesResponse,
                'completado'=>$completado,
                'nota_final'=>($completado)?$nota_final:null
            );

            return $materiaResponse;
        }

        return array();
    }
}