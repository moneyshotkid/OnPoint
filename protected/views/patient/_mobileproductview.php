<?php $i=0; foreach($model as $data): ?>
    <?php // if($i%4==0){  echo   '<div class="clearfix visible-xs-block"></div>';$i=0; } $i++;?>

<div class="col-sm-6 col-md-3 box" id="<?php echo $data->strain; ?>">
    <div class="magniflier thumbnail" style="background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/images/inventory/<?php echo $data->mainImage; ?>);">
        <h4 class="text-center"><span class="label label-info"><?php echo CHtml::encode($data->type); ?></span></h4>

        <div class="caption">
            <div class="row">  <h5 class="text-center"><?php echo CHtml::encode($data->strain); ?></h5></div>
            <div class="row">
                <?php if($data->cpg>0): ?>
                <div class="col-md-4 col-xs-4">
                    <button class="btn btn-primary btn-xs" type="button">
                       Gram <span class="badge"><?php echo CHtml::encode($data->cpg); ?></span>
                    </button>
                </div>
        <?php endif; ?>
    <?php if($data->twograms>0): ?>
                <div class="col-md-4 col-xs-4 price">
                    <button class="btn btn-success btn-xs" type="button">
                        1/8 &nbsp;&nbsp; <span class="badge"><?php echo CHtml::encode($data->twograms); ?></span>
                    </button>
                </div>
    <?php endif; ?>
    <?php if($data->eigth>0): ?>
                <div class="col-md-4 col-xs-4">
                    <button class="btn btn-info  btn-xs" type="button">
                       1/4 &nbsp;&nbsp; <span class="badge"><?php echo CHtml::encode($data->eigth); ?></span>
                    </button>
                </div>
    <?php endif; ?>
    <?php if($data->fourgrams>0): ?>
                <div class="col-md-4 col-xs-4 price">
                    <button class="btn btn-warning btn-xs" type="button">
                        1/2 <span class="badge"><?php echo CHtml::encode($data->fourgrams); ?></span>
                    </button>
                </div>
    <?php endif; ?>
            </div>

            <p class="text-center"><?php echo CHtml::encode($data->description); ?></p>



        </div>
    </div>
</div>

<?php endforeach; ?>