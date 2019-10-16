<?php
/* @var $this yii\web\View */

$this->title = 'Te cuido';
?>
<div class="site-index">   

    <div class="body-content">

        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="flaticon-map-location"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Unidades Residenciales</span>
                        <span class="info-box-number">&nbsp;</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                            <i class="fa fa-arrow-circle-right"></i> 
                            <?= \yii\bootstrap\Html::a('Ver más', ['/housing-estate/index'], ['style' => 'color: white']); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="flaticon-app"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Bloques</span>
                        <span class="info-box-number">&nbsp;</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                            <i class="fa fa-arrow-circle-right"></i>                            
                            <?= \yii\bootstrap\Html::a('Ver más', ['/blocks/index'], ['style' => 'color: white']); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-building"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Apartamentos</span>
                        <span class="info-box-number">&nbsp;</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                            <i class="fa fa-arrow-circle-right"></i>                            
                            <?= \yii\bootstrap\Html::a('Ver más', ['/apartments/index'], ['style' => 'color: white']); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="flaticon-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Residentes</span>
                        <span class="info-box-number">&nbsp;</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                            <i class="fa fa-arrow-circle-right"></i> 
                            <?= \yii\bootstrap\Html::a('Ver más', ['/residents/index'], ['style' => 'color: white']); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-paw"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Mascotas</span>
                        <span class="info-box-number">&nbsp;</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                            <i class="fa fa-arrow-circle-right"></i>                            
                            <?= \yii\bootstrap\Html::a('Ver más', ['/pets/index'], ['style' => 'color: white']); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-car"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Vehículos</span>
                        <span class="info-box-number">&nbsp;</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                            <i class="fa fa-arrow-circle-right"></i>                            
                            <?= \yii\bootstrap\Html::a('Ver más', ['/apartments/index'], ['style' => 'color: white']); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="flaticon-profile"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Administradores</span>
                        <span class="info-box-number">&nbsp;</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                            <i class="fa fa-arrow-circle-right"></i> 
                            <?= \yii\bootstrap\Html::a('Ver más', ['/administrators/index'], ['style' => 'color: white']); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="flaticon-interface"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Puertas</span>
                        <span class="info-box-number">&nbsp;</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                            <i class="fa fa-arrow-circle-right"></i>                            
                            <?= \yii\bootstrap\Html::a('Ver más', ['/gates/index'], ['style' => 'color: white']); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            
        </div>

    </div>
</div>
