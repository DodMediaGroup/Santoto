<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Agregar</strong> nuevo grupo</h2>
                <div class="additional-btn">
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                </div>
            </div>
            <div class="widget-content padding">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'grupos-form',
                    'action'=>($model->isNewRecord)?$this->createUrl('grupos/grupos__create'):$this->createUrl('grupos/grupos__update/'.$model->id),
                    'enableAjaxValidation'=>false,
                    'htmlOptions'=>array(
                        'class'=>'form-horizontal',
                        'role'=>'form',
                        'method'=>'post',
                        'data-form__success'=>'',
                    ),
                )); ?>
                <div class="alert alert-warning">
                    Una vez creado el grupo no podra modificar las materias y la cantidad de cortes. El numero de cortes actual es de <?php echo $cortes->value; ?>. Para modificarlo dirijase al módulo de configuración.
                </div>
                <div class="form-group">
                    <?php echo $form->label($model, 'periodo', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->dropDownList($model, 'periodo', MyMethods::getListSelect('Periodos','id','nombre',array(
                            'filter'=>'estado=1'
                        )), array('class'=>'form-control','required'=>true,'disabled'=>true)); ?>
                        <?php echo $form->hiddenField($model, 'periodo'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model, 'curso', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->dropDownList($model, 'curso', MyMethods::getListSelect('Cursos','id','nombre',array(
                            'filter'=>'estado=1'
                        )), array('class'=>'form-control','required'=>true)); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>