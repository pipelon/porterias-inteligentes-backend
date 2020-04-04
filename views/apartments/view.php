<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Apartments */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Apartamento', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartments-view box box-primary">
    <div class="box-header">
        <?php if (\Yii::$app->user->can('/apartments/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/apartments/create') || \Yii::$app->user->can('/*')) : ?> 
            <?= Html::a('<i class="flaticon-add" style="font-size: 20px"></i> ' . 'Crear apartamento', ['create'], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/apartments/update') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-edit-1" style="font-size: 20px"></i> ' . 'Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/apartments/delete') || \Yii::$app->user->can('/*')) : ?>        
            <?=
            Html::a('<i class="flaticon-circle" style="font-size: 20px"></i> ' . 'Borrar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Está seguro que desea eliminar este ítem?',
                    'method' => 'post',
                ],
            ])
            ?>
        <?php endif; ?> 
    </div>
    <div class="box-body table-responsive no-padding">
        <?=
        DetailView::widget([
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
                'floor',
                'name',
                'phone_number_1',
                'phone_number_2',
                'cellphone_number_1',
                'cellphone_number_2',
                [
                    'attribute' => 'active',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Yii::$app->utils->getConditional($data->active);
                    },
                ],
                [
                    'label'  => 'Residentes',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Yii::$app->utils->getResidentesByApto($data->residents);
                    },
                ],
                [
                    'label'  => 'Mascotas',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Yii::$app->utils->getPetsByApto($data->pets);
                    },
                ],
                [
                    'label'  => 'Vehículos',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Yii::$app->utils->getVehiclesByApto($data->vehicles);
                    },
                ],
                'created:datetime',
                'created_by',
                'modified:datetime',
                'modified_by',
            ],
        ])
        ?>
    </div>
</div>
