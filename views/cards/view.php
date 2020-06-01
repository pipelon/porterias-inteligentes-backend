<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cards */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Tarjetas de acceso', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cards-view box box-primary">
    <div class="box-header">
        <?php if (\Yii::$app->user->can('/cards/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/cards/update') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-edit-1" style="font-size: 20px"></i> ' . 'Actualizar', ['update', 'id' => $model->code], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/cards/delete') || \Yii::$app->user->can('/*')) : ?>        
            <?=
            Html::a('<i class="flaticon-circle" style="font-size: 20px"></i> ' . 'Borrar', ['delete', 'id' => $model->code], [
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
                'code',
                [
                    'attribute' => 'resident_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return '<b>' . $data->resident->apartment->housingEstate->name . ' </b>'
                                .'<b>(' . $data->resident->apartment->name . ')</b>'
                                . ' - ' . $data->resident->name;
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
        ])
        ?>
    </div>
</div>
