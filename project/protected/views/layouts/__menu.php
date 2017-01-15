<?php
$path = explode("/",Yii::app()->request->pathInfo);
?>

<li>
    <a href='<?php echo $this->createUrl('index/') ?>' class="<?php echo (count($path) > 1)?((strtolower($path[1]) == 'index')?'active':''):'active'; ?>">
        <i class='icon-home-3'></i>
        <span>Dashboard</span>
    </a>
</li>

<li>
    <a href="<?php echo $this->createUrl('grupos/admin') ?>" class="<?php echo (strtolower($path[0]) == 'grupos')?'active':''; ?>">
        <i class="fa fa-group"></i>
        <span>Grupos</span>
    </a>
</li>

<li class='has_sub'>
    <a href='#' class="<?php echo (strtolower($path[0]) == 'pensul')?'active':''; ?>">
        <i class='fa fa-building-o'></i>
        <span>Pensul</span>
        <span class="pull-right">
			<i class="fa fa-angle-down"></i>
		</span>
    </a>
    <ul>
        <li>
            <a href='<?php echo $this->createUrl('pensul/periodos') ?>' class="<?php echo (count($path) > 1)?((strtolower($path[0]) == 'pensul' && strtolower($path[1]) == 'periodos')?'active':''):''; ?>">
                <span>Periodos</span>
            </a>
        </li>
        <li>
            <a href='<?php echo $this->createUrl('pensul/cursos') ?>' class="<?php echo (count($path) > 1)?((strtolower($path[0]) == 'pensul' && strtolower($path[1]) == 'cursos')?'active':''):''; ?>">
                <span>Cursos</span>
            </a>
        </li>
        <li>
            <a href='<?php echo $this->createUrl('pensul/materias') ?>' class="<?php echo (count($path) > 1)?((strtolower($path[0]) == 'pensul' && strtolower($path[1]) == 'materias')?'active':''):''; ?>">
                <span>Materias</span>
            </a>
        </li>
    </ul>
</li>