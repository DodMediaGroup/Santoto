<div class="page-heading">
    <h1><i class="fa fa-book"></i> Materias</h1>
    <h3>Lista de materias para el grupo <strong><?php echo $grupo->curso0->nombre.' - '.$grupo->periodo0->nombre; ?></strong></h3>
</div>

<div class="row">
    <?php foreach ($grupo->grupoMateriases as $key=>$materia){ ?>
        <div class="col-md-6">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong><?php echo $materia->materia0->nombre; ?></strong></h2>
                    <div class="additional-btn">
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    </div>
                </div>
                <div class="widget-content padding">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nombre</th>
                                <th>Porcentaje</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Nombre</th>
                                <th>Porcentaje</th>
                                <th>Acciones</th>
                            </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($materia->cortes as $key=>$corte){ ?>
                                    <tr>
                                        <td><?php echo $key+1; ?></td>
                                        <td><?php echo $corte->nombre; ?></td>
                                        <td>
                                            <?php $form=$this->beginWidget('CActiveForm', array(
                                                'id'=>'cortes-form-'.$key,
                                                'action'=>$this->createUrl('grupos/cortes/'.$corte->id),
                                                'enableAjaxValidation'=>false,
                                                'htmlOptions'=>array(
                                                    'class'=>'form-horizontal',
                                                    'role'=>'form',
                                                    'method'=>'post',
                                                    'data-form__success'=>'',
                                                ),
                                            )); ?>
                                                <div class="input-group" style="width:120px;">
                                                    <?php echo $form->hiddenField($corte, 'id'); ?>
                                                    <?php echo $form->numberField($corte, 'porcentaje', array('class'=>'form-control','min'=>0,'max'=>100)); ?>
                                                    <span class="input-group-addon">%</span>
                                                </div>
                                            <?php $this->endWidget(); ?>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                                <a href="#" class="btn__send-form btn btn-default" data-toggle="tooltip" title="Guardar">
                                                    <i class="fa fa-save"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>