<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Residents */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Residentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="residents-view box box-primary">
    <div class="box-header">
        <?php if (\Yii::$app->user->can('/residents/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/administrators/create') || \Yii::$app->user->can('/*')) : ?> 
            <?= Html::a('<i class="flaticon-add" style="font-size: 20px"></i> ' . 'Crear residente', ['create'], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/residents/update') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-edit-1" style="font-size: 20px"></i> ' . 'Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/residents/delete') || \Yii::$app->user->can('/*')) : ?>        
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
                    'attribute' => 'apartment_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return '<b>' . $data->apartment->housingEstate->name . '</b>'
                                . ' - ' . $data->apartment->name;
                    },
                ],
                'name',
                [
                    'attribute' => 'sex',
                    'value' => function ($data) {
                        return Yii::$app->params['sex'][$data->sex];
                    },
                ],
                [
                    'attribute' => 'document_type',
                    'value' => function ($data) {
                        return Yii::$app->params['document_type'][$data->document_type];
                    },
                ],
                'document:integer',
                'email:email',
                'phone',
                [
                    'attribute' => 'photo',
                    'format' => 'html',
                    'value' => function($data) {
                        return Html::img('@web/' . $data->photo, ['style' => 'width:50px']);
                    },
                    'filter' => false,
                ],
                'tags:ntext',
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
