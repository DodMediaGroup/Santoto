<div class="page-heading">
    <h1><i class="fa fa-tag"></i> Cursos</h1>
    <h3>Cursos a los que se les habilita el sistema</h3>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Lista</strong> de cursos</h2>
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
                        <?php foreach ($cursos as $key => $curso){
                            $trId = 'curso__tr__$key';
                            ?>
                            <tr id="<?php echo $trId; ?>">
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $curso->nombre; ?></td>
                                <td>
                                    <?php
                                    $status = ($curso->estado == 1)?'Activo':'Inactivo';
                                    $label = ($curso->estado == 1)?'success':'default';
                                    ?>
                                    <span class="label label-<?php echo $label ?>"><?php echo $status ?></span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <a href="<?php echo $this->createUrl('pensul/materias?c='.$curso->id); ?>" class="btn btn-default" data-toggle="tooltip" title="Materias">
                                            <i class="fa fa-book"></i>
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
    <div class="col-md-5">
        <?php
        $this->renderPartial('cursos__form', array(
            'model'=>$model
        ));
        ?>
    </div>
</div>

