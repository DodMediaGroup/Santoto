<div class="page-heading">
    <h1><i class="fa fa-book"></i> Materias</h1>
    <h3>Materias para cada curso</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Lista</strong> de materias</h2>
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
                            <th>Curso</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nombre</th>
                            <th>Curso</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach ($materias as $key => $materia){
                            $trId = 'materia__tr__$key';
                            ?>
                            <tr id="<?php echo $trId; ?>">
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $materia->nombre; ?></td>
                                <td><?php echo $materia->curso0->nombre; ?></td>
                                <td>
                                    <?php
                                    $status = ($materia->estado == 1)?'Activo':'Inactivo';
                                    $label = ($materia->estado == 1)?'success':'default';
                                    ?>
                                    <span class="label label-<?php echo $label ?>"><?php echo $status ?></span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-xs">

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
$this->renderPartial('materias__form', array(
    'model'=>$model
));
?>