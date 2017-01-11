<div class="page-heading">
    <h1><i class="fa fa-calendar-o"></i> Periodos</h1>
    <h3>Periodos academicos</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Lista</strong> de periodos</h2>
                <div class="additional-btn">
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                </div>
            </div>
            <div class="widget-content padding">
                <div class="table-responsive">
                    <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach ($periodos as $key => $periodo){
                            $trId = 'periodo__tr__$key';
                        ?>
                            <tr id="<?php echo $trId; ?>">
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $periodo->nombre; ?></td>
                                <td>
                                    <?php
                                    $status = ($periodo->estado == 1)?'Activo':'Inactivo';
                                    $label = ($periodo->estado == 1)?'success':'default';
                                    ?>
                                    <span class="label label-<?php echo $label ?>"><?php echo $status ?></span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <?php if($periodo->estado == 0){ ?>
                                            <a href="<?php echo $this->createUrl('pensul/periodos__active/'.$periodo->id); ?>" class="btn btn-default" data-toggle="tooltip" title="Activar">
                                                <i class="fa fa-star"></i>
                                            </a>
                                        <?php } ?>
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
</div>

<?php $this->renderPartial('periodos__form', array(
    'model'=>$model
)); ?>