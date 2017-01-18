<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'alumnos-form',
    'action'=>($model->isNewRecord)?$this->createUrl('alumnos/create'):$this->createUrl('alumnos/update/'.$model->id),
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'class'=>'form',
        'role'=>'form',
        'method'=>'post',
        'data-form__success'=>'',
    ),
)); ?>

<div class="row">
    <div class="col-md-12">
        <?php if($form->errorSummary($model) != ''){ ?>
            <div class="alert alert-danger"><?php echo $form->errorSummary($model); ?></div>
        <?php } ?>
    </div>
    <div class="col-md-6">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Datos</strong> personales</h2>
                <div class="additional-btn">
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                </div>
            </div>
            <div class="widget-content padding">
                <div class="form-group">
                    <?php echo $form->label($model, 'nombres', array('class'=>'control-label')); ?>
                    <?php echo $form->textField($model, 'nombres', array(
                        'class'=>'form-control',
                        'required'=>true,
                        'maxlength'=>45
                    )); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model, 'apellidos', array('class'=>'control-label')); ?>
                    <?php echo $form->textField($model, 'apellidos', array(
                        'class'=>'form-control',
                        'required'=>true,
                        'maxlength'=>45
                    )); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model, 'email', array('class'=>'control-label')); ?>
                    <?php echo $form->emailField($model, 'email', array(
                        'class'=>'form-control',
                        'required'=>true,
                        'maxlength'=>155
                    )); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Datos</strong> acceso</h2>
                <div class="additional-btn">
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                </div>
            </div>
            <div class="widget-content padding">
                <div class="alert alert-warning">
                    El Username debe ser único para cada alumno.
                </div>
                <div class="form-group">
                    <?php echo $form->label($model, 'username', array('class'=>'control-label')); ?>
                    <?php echo $form->textField($model, 'username', array(
                        'class'=>'form-control',
                        'required'=>true,
                        'maxlength'=>155
                    )); ?>
                </div>
                <div class="form-group">
                    <label for="Alumnos_password" class="control-label">Password</label>
                    <input type="text" id="Alumnos_password" name="Alumnos[password]" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>