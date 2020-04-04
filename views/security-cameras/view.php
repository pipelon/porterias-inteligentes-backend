<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SecurityCameras */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cámaras de seguridad', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="security-cameras-view box box-primary">
    <div class="box-header">
        <?php  if (\Yii::$app->user->can('/security-cameras/index') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> '.'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php  endif;  ?> 
        <?php if (\Yii::$app->user->can('/security-cameras/create') || \Yii::$app->user->can('/*')) : ?> 
            <?= Html::a('<i class="flaticon-add" style="font-size: 20px"></i> ' . 'Crear cámara de seguridad', ['create'], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?> 
        <?php  if (\Yii::$app->user->can('/security-cameras/update') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-edit-1" style="font-size: 20px"></i> '.'Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php  endif;  ?> 
        <?php  if (\Yii::$app->user->can('/security-cameras/delete') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-circle" style="font-size: 20px"></i> '.'Borrar', ['delete', 'id' => $model->id], [        
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Está seguro que desea eliminar este ítem?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php  endif;  ?> 
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'housing_estate_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->housingEstate->name;
                    },
                ],
                'name',
                'description',
                'camera_ip',
                'code',
                [
                    'attribute' => 'active',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Yii::$app->utils->getConditional($data->active);
                    },
                ],
                'created:datetime',
                'created_by',
                'modified:datetime',
                'modified_by',
            ],
        ]) ?>
    </div>
</div>
