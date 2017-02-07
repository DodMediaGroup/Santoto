<div class="page-heading">
    <h1><i class="icon-graduation-cap"></i> Alumnos</h1>
    <h3>Lista de alumnos registrados en el sistema</h3>
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
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Grupo Act.</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Grupo Act.</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach ($alumnos as $key => $alumno){
                            $trId = 'alumno__tr__$key';
                            ?>
                            <tr id="<?php echo $trId; ?>">
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $alumno->username; ?></td>
                                <td><?php echo $alumno->nombres; ?></td>
                                <td><?php echo $alumno->apellidos; ?></td>
                                <td>
                                    <?php if($alumno->email != '') echo $alumno->email;
                                    else{ ?>
                                        <a href="<?php echo $this->createUrl('alumnos/update/'.$alumno->id); ?>"><small>Agregar email</small></a>
                                    <?php } ?>
                                </td>
                                <td><?php
                                    $grupo = $alumno->getGroup();
                                    echo ($grupo)?($grupo->grupo0->curso0->nombre.' - '.$grupo->grupo0->periodo0->nombre):'Ninguno' ?></td>
                                <td>
                                    <span class="label label-<?php echo ($alumno->user0->estado == 1)?'success':'danger'; ?>"><?php echo ($alumno->user0->estado == 1)?'Activo':'Suspendido'; ?></span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <a href="<?php echo $this->createUrl('alumnos/update/'.$alumno->id); ?>" class="btn btn-default" data-toggle="tooltip" title="Modificar">
                                            <i class="fa fa-edit"></i>
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