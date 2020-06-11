<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccesscardsVehiclesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tarjetas de acceso vehicular';
$this->params['breadcrumbs'][] = $this->title;

$template = '';
if (\Yii::$app->user->can('/accesscards-vehicles/view')) {
    $template .= '{view} ';
}
if (\Yii::$app->user->can('/accesscards-vehicles/update')) {
    $template .= '{update} ';
}
if (\Yii::$app->user->can('/accesscards-vehicles/delete')) {
    $template .= '{delete} ';
}
if (\Yii::$app->user->can('/accesscards-vehicles/*') || \Yii::$app->user->can('/*')) {
    $template = '{view}  {update}  {delete}';
}
?>
<div class="accesscards-vehicles-index box box-primary">
    <div class="box-header with-border">
    <?php  if (\Yii::$app->user->can('/accesscards-vehicles/create') || \Yii::$app->user->can('/*')) :  ?> 
        <?= Html::a('<i class="flaticon-add" style="font-size: 20px"></i> '.'Nueva tarjeta de acceso vehicular', ['create'], ['class' => 'btn btn-primary']) ?>
    <?php  endif;  ?> 
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                'code',
                [
                    'attribute' => 'vehicle_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->vehicle->license_plate;
                    },
                    'filter' => yii\helpers\ArrayHelper::map(
                            \app\models\Vehicles::find()
                                        ->orderBy('license_plate ASC')
                                        ->all()
                                , 'id', 'license_plate',
                                function($model) {
                            return $model['apartment']['housingEstate']['name'] . ' - (Apto: ' . $model['apartment']['name'] . ')';
                        }
                        )
                ],
                'description',
                'active',
                'created',
                // 'created_by',
                // 'modified',
                // 'modified_by',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => $template,
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="flaticon-search-magnifier-interface-symbol" style="font-size: 20px"></span>', $url, [
                                        'title' => 'Ver',
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="flaticon-edit-1" style="font-size: 20px"></span>', $url, [
                                        'title' => 'Editar',
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="flaticon-circle" style="font-size: 20px"></span>', $url, [
                                        'data-confirm' => '¿Está seguro que desea eliminar este ítem?',
					'data-method' => 'post',
                                        'title' => 'Borrar',
                            ]);
                        }
                    ]
                ],
            ],
        ]); ?>
    </div>
</div>
