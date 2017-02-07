<div class="page-heading">
    <h1><i class="fa fa-cogs"></i> Configuración</h1>
    <h3>Modifique los valores segun su necesidad.</h3>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Variables</strong> de configuración</h2>
                <div class="additional-btn">
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                </div>
            </div>
            <div class="widget-content padding">
                <?php foreach ($variablesConf as $key=>$variable){ ?>
                    <form action="<?php echo $this->createUrl('settings/variable_update/'.$variable->id); ?>" method="post">
                        <div class="form-group">
                            <label for="VariableConf_<?php echo $variable->id ?>"><?php echo $variable->nombre; ?></label>
                            <input type="text" class="form-control" name="Variable[value]" id="VariableConf_<?php echo $variable->id ?>" value="<?php echo $variable->value; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="" data-original-title="Establecer"><i class="icon-check-1"></i> Establecer</button>
                    </form>
                    <?php echo ($key < (count($variablesConf) - 1)?'<hr>':'') ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>