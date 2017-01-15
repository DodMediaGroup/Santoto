<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Agregar</strong> nueva materia</h2>
                <div class="additional-btn">
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                </div>
            </div>
            <div class="widget-content padding">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'cursos-form',
                    'action'=>($model->isNewRecord)?$this->createUrl('pensul/materias__create'):$this->createUrl('penusl/materias__update/'.$model->id),
                    'enableAjaxValidation'=>false,
                    'htmlOptions'=>array(
                        'class'=>'form-horizontal',
                        'role'=>'form',
                        'method'=>'post',
                        'data-form__success'=>'',
                    ),
                )); ?>
                <div class="form-group">
                    <?php echo $form->label($model, 'nombre', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->textField($model,'nombre',array('class'=>'form-control','required'=>true)); ?>
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