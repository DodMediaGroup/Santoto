<div class="page-heading">
    <h1><i class="fa fa-group"></i> Grupos</h1>
    <h3>Lista de grupos creados</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Lista</strong> de grupos</h2>
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
                            <th>Periodo</th>
                            <th>Curso</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Periodo</th>
                            <th>Curso</th>
                            <th>Acciones</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach ($grupos as $key => $grupo){
                            $trId = 'grupo__tr__$key';
                            ?>
                            <tr id="<?php echo $trId; ?>">
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $grupo->periodo0->nombre; ?></td>
                                <td><?php echo $grupo->curso0->nombre; ?></td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <a href="<?php echo $this->createUrl('grupos/materias/'.$grupo->id); ?>" class="btn btn-default" data-toggle="tooltip" title="Materias">
                                            <i class="fa fa-book"></i>
                                        </a>
                                        <a href="<?php echo $this->createUrl('grupos/alumnos/'.$grupo->id); ?>" class="btn btn-default" data-toggle="tooltip" title="Alumnos">
                                            <i class="fa fa-group"></i>
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
</div>

<?php
    $this->renderPartial('grupos__form', array(
        'model'=>$model,
        'cortes'=>$cortes
    ));
?>