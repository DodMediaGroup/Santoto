<?php

class GruposController extends Controller {

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
                    'grupos__create',
                    'materias',
                    'cortes',
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
        $periodo = Periodos::model()->findByAttributes(array('estado'=>1));
        if($periodo == null)
            throw new CHttpException(404, 'The requested page does not exist');

        $grupos = Grupos::model()->findAllByAttributes(array('periodo'=>$periodo->id));
        $model = new Grupos;
        $model->periodo = $periodo->id;

        $cortes = SantotoConfigs::model()->findByPk(1);

        $this->render('grupos', array(
            'grupos'=>$grupos,
            'model'=>$model,
            'cortes'=>$cortes
        ));
    }
    public function actionGrupos__create(){
        if(isset($_POST['Grupos'])){
            $model = new Grupos;
            $model->attributes = $_POST['Grupos'];
            if($model->save()){
                $materias = Materias::model()->findAllByAttributes(array('curso'=>$model->curso, 'estado'=>1));
                $notaMaxima = SantotoConfigs::model()->findByPk(2);
                foreach ($materias as $key=>$materia){
                    $modelMateria = new GrupoMaterias;
                    $modelMateria->grupo = $model->id;
                    $modelMateria->materia = $materia->id;
                    $modelMateria->nota_maxima = floatval($notaMaxima->value);
                    if($modelMateria->save()){
                        $numeroCortes = SantotoConfigs::model()->findByPk(1);
                        for ($i = 0; $i < $numeroCortes->value; $i++){
                            $modelCorte = new Cortes;
                            $modelCorte->materia = $modelMateria->id;
                            $modelCorte->nombre = 'Corte N°'.($i+1);
                            $modelCorte->porcentaje = number_format((100 / $numeroCortes->value), 2, '.', '');
                            $modelCorte->save();
                        }
                    }
                }

                $this->redirect('materias/'.$model->id.'/');
            }

            $this->redirect(array('admin'));
        }
        else
            throw new CHttpException(404, 'The requested page does not exist');
    }

    public function actionMaterias($id){
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile(Yii::app()->baseUrl.'/js/modules/grupos.js', CClientScript::POS_END);

        $grupo = $this->loadGrupo($id);
        $this->render('materias', array(
            'grupo'=>$grupo
        ));
    }

    public function actionCortes($id){
        $corte = $this->loadCorte($id);
        if(isset($_POST['Cortes'])){
            if($id == $_POST['Cortes']['id']){
                $corte->porcentaje = $_POST['Cortes']['porcentaje'];
                $corte->save();

                $this->redirect(array('/grupos/materias/'.$corte->materia0->grupo.'/'));
            }
        }

        throw new CHttpException(404, 'The requested page does not exist');
    }

    private function loadGrupo($id){
        $grupo = Grupos::model()->findByPk($id);
        if($grupo == null)
            throw new CHttpException(404, 'The requested page does not exist');
        return $grupo;
    }
    private function loadCorte($id){
        $corte = Cortes::model()->findByPk($id);
        if($corte == null)
            throw new CHttpException(404, 'The requested page does not exist');
        return $corte;
    }
}