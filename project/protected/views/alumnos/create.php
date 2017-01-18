<div class="page-heading">
    <h1><i class="icon-graduation-cap"></i> Alumnos</h1>
    <h3>Agregar nuevo alumno</h3>
</div>

<?php
    $this->renderPartial('_form', array(
        'model'=>$model
    ));
?>