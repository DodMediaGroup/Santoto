<?php

class SettingsController extends Controller {

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
                    'variable_update',
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
        $variablesConfId = [1, 2];
        $variablesConf = array();
        for($i = 0; $i < count($variablesConfId); $i++){
            $variablesConf[] = SantotoConfigs::model()->findByPk($variablesConfId[$i]);
        }

        $this->render('admin', array(
            'variablesConf'=>$variablesConf,
        ));
    }

    public function actionVariable_update($id){
        $variable = $this->loadVariable($id);
        if(isset($_POST['Variable'])){
            $variable->value = $_POST['Variable']['value'];
            $variable->save();

            $this->redirect(array('admin'));
        }
        else
            throw new CHttpException(404, 'The requested page does not exist');
    }
    private function loadVariable($id){
        $variable = SantotoConfigs::model()->findByPk($id);
        if($variable == null)
            throw new CHttpException(404, 'The requested page does not exist');
        return $variable;
    }
}