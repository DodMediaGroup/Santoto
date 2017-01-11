<?php

class PensulController extends Controller {

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
                    'periodos','periodos__create','periodos__active',
                    'cursos','cursos__create',
                    'materias','materias__create',
                ),
                'users'=>array('@'),
                'expression'=>'MyMethods::isAdmin()',
            ),
            array('deny',
                'users'=>array('*')
            ),
        );
    }

    public function actionPeriodos(){
        $periodos = Periodos::model()->findAll(array(
            'condition'=>'t.estado != 2'
        ));
        $model = new Periodos;

        $this->render('periodos', array(
            'periodos'=>$periodos,
            'model'=>$model
        ));
    }
    public function actionPeriodos__create(){
        if(isset($_POST['Periodos'])){
            $model = new Periodos;
            $model->attributes = $_POST['Periodos'];
            $model->save();

            $this->redirect(array('periodos'));
        }
        else
            throw new CHttpException(404, 'The requested page does not exist');
    }
    public function actionPeriodos__active($id){
        $periodo = $this->loadPeriodo($id);
        $periodo->estado = 1;
        $periodo->save();

        $this->redirect(array('periodos'));
    }
    private function loadPeriodo($id){
        $periodo = Periodos::model()->findByAttributes(array(
            'id'=>$id
        ),array(
            'condition'=>'t.estado != 2'
        ));
        if($periodo == null)
            throw new CHttpException(404, 'The requested page does not exist');
        return $periodo;
    }


    public function actionCursos(){
        $cursos = Cursos::model()->findAll(array(
            'condition'=>'t.estado != 2',
            'order'=>'t.nombre ASC'
        ));
        $model = new Cursos;

        $this->render('cursos', array(
            'cursos'=>$cursos,
            'model'=>$model
        ));
    }
    public function actionCursos__create(){
        if(isset($_POST['Cursos'])){
            $model = new Cursos;
            $model->attributes = $_POST['Cursos'];
            $model->save();

            $this->redirect(array('cursos'));
        }
        else
            throw new CHttpException(404, 'The requested page does not exist');
    }
    private function loadCurso($id){
        $curso = Cursos::model()->findByAttributes(array(
            'id'=>$id
        ), array(
            'condition'=>'t.estado != 2'
        ));
        if($curso == null)
            throw new CHttpException(404, 'The requested page does not exist');
        return $curso;
    }


    public function actionMaterias(){
        $materias = Materias::model()->findAll(array(
            'condition'=>'t.estado != 2',
            'order'=>'t.nombre ASC'
        ));
        if(isset($_GET['c'])){
            $curso = $this->loadCurso($_GET['c']);
            $materias = Materias::model()->findAllByAttributes(array(
                'curso'=>$curso->id
            ),array(
                'condition'=>'t.estado != 2',
                'order'=>'t.nombre ASC'
            ));
        }
        $model = new Materias;

        $this->render('materias', array(
            'materias'=>$materias,
            'model'=>$model
        ));
    }
    public function actionMaterias__create(){
        if(isset($_POST['Materias'])){
            $model = new Materias;
            $model->attributes = $_POST['Materias'];

            $curso = $this->loadCurso($model->curso);
            if($curso != null){
                $model->save();
                $this->redirect(array('materias'));
            }
        }
        else
            throw new CHttpException(404, 'The requested page does not exist');
    }
}