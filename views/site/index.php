<?php
/* @var $this yii\web\View */

$this->title = 'Te cuido';
?>
<div class="site-index">   

    <div class="body-content">

        <div class="row">
            <?php if (\Yii::$app->user->can('/housing-estate/index') || \Yii::$app->user->can('/*')) : ?>
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
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('/apartments/index') || \Yii::$app->user->can('/*')) : ?>
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
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('/residents/index') || \Yii::$app->user->can('/*')) : ?>
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
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('/pets/index') || \Yii::$app->user->can('/*')) : ?>
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
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('/apartments/index') || \Yii::$app->user->can('/*')) : ?>
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
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('/administrators/index') || \Yii::$app->user->can('/*')) : ?>
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
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('/gates/index') || \Yii::$app->user->can('/*')) : ?>
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
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('/security-cameras/index') || \Yii::$app->user->can('/*')) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="fa fa-camera"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Cámaras</span>
                            <span class="info-box-number">&nbsp;</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-arrow-circle-right"></i>                            
                                <?= \yii\bootstrap\Html::a('Ver más', ['/security-cameras/index'], ['style' => 'color: white']); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('/security-guards/index') || \Yii::$app->user->can('/*')) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="flaticon-profile-1"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Asignar porteros</span>
                            <span class="info-box-number">&nbsp;</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-arrow-circle-right"></i>                            
                                <?= \yii\bootstrap\Html::a('Ver más', ['/security-guards/index'], ['style' => 'color: white']); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('/accesscards/index') || \Yii::$app->user->can('/*')) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="flaticon-lock"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Tarjetas de acceso peatonal</span>
                            <span class="info-box-number">&nbsp;</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-arrow-circle-right"></i>                            
                                <?= \yii\bootstrap\Html::a('Ver más', ['/accesscards/index'], ['style' => 'color: white']); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('/accesscards-vehicles/index') || \Yii::$app->user->can('/*')) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="flaticon-lock"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Tarjetas de acceso vehicular</span>
                            <span class="info-box-number">&nbsp;</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-arrow-circle-right"></i>                            
                                <?= \yii\bootstrap\Html::a('Ver más', ['/accesscards-vehicles/index'], ['style' => 'color: white']); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('/accesscards-log/index') || \Yii::$app->user->can('/*')) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="flaticon-clipboard"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">LOG T. de acceso peatonal</span>
                            <span class="info-box-number">&nbsp;</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-arrow-circle-right"></i>                            
                                <?= \yii\bootstrap\Html::a('Ver más', ['/accesscards-log/index'], ['style' => 'color: white']); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('/accesscardsvehicles-log/index') || \Yii::$app->user->can('/*')) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="flaticon-clipboard"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">LOG T. de acceso vehicular</span>
                            <span class="info-box-number">&nbsp;</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-arrow-circle-right"></i>                            
                                <?= \yii\bootstrap\Html::a('Ver más', ['/accesscardsvehicles-log/index'], ['style' => 'color: white']); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('/gates-logs/index') || \Yii::$app->user->can('/*')) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="flaticon-clipboard"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">LOG Apertura de puertas</span>
                            <span class="info-box-number">&nbsp;</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-arrow-circle-right"></i>                            
                                <?= \yii\bootstrap\Html::a('Ver más', ['/gates-logs/index'], ['style' => 'color: white']); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>
