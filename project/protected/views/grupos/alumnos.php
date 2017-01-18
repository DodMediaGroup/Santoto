<div class="page-heading">
    <h1><i class="fa fa-group"></i> Grupo [<?php echo $grupo->curso0->nombre.' - '.$grupo->periodo0->nombre; ?>]</h1>
    <h3>Lista de alumnos</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Lista</strong> de alumnos</h2>
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
                            <th>Username</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach ($grupo->grupoAlumnoses as $key => $gAlumno){
                            $alumno = $gAlumno->alumno0;
                            $trId = 'alumno__tr__$key';
                            ?>
                            <tr id="<?php echo $trId; ?>">
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $alumno->username; ?></td>
                                <td><?php echo $alumno->nombres.' '.$alumno->apellidos; ?></td>
                                <td><?php echo $alumno->email; ?></td>
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

    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Agregar</strong> alumno</h2>
                <div class="additional-btn">
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                </div>
            </div>
            <div class="widget-content padding">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <form action="<?php echo $this->createUrl('alumnos/getList'); ?>" id="alumno-form" class="form">
                            <div class="form-group">
                                <label for="Alumnos_username" class="control-label">Username</label>
                                <input type="text" id="Alumnos_username" class="form-control">
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-12">
                        <table class="table table-striped">
                            <thead>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody id="alumnos_showload" data-url-go="<?php echo $this->createUrl('grupos/add_alumno/'.$grupo->id); ?>"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>