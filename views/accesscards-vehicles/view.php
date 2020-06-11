<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AccesscardsVehicles */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Tarjetas de acceso vehicular', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accesscards-vehicles-view box box-primary">
    <div class="box-header">
        <?php  if (\Yii::$app->user->can('/accesscards-vehicles/index') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> '.'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php  endif;  ?> 
        <?php  if (\Yii::$app->user->can('/accesscards-vehicles/update') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-edit-1" style="font-size: 20px"></i> '.'Actualizar', ['update', 'id' => $model->code], ['class' => 'btn btn-primary']) ?>
        <?php  endif;  ?> 
        <?php  if (\Yii::$app->user->can('/accesscards-vehicles/delete') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-circle" style="font-size: 20px"></i> '.'Borrar', ['delete', 'id' => $model->code], [        
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
                'code',
                [
                    'attribute' => 'vehicle_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return '<b>' . $data->vehicle->apartment->housingEstate->name . '</b>'
                                . ' - ' . $data->vehicle->apartment->name. '</b>'
                                . ' - ' . $data->vehicle->license_plate;
                    },
                ],
                'description',
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
