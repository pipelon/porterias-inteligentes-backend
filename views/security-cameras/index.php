<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SecurityCamerasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cámaras de seguridad';
$this->params['breadcrumbs'][] = $this->title;

$template = '';
if (\Yii::$app->user->can('/security-cameras/view')) {
    $template .= '{view} ';
}
if (\Yii::$app->user->can('/security-cameras/update')) {
    $template .= '{update} ';
}
if (\Yii::$app->user->can('/security-cameras/delete')) {
    $template .= '{delete} ';
}
if (\Yii::$app->user->can('/security-cameras/*') || \Yii::$app->user->can('/*')) {
    $template = '{view}  {update}  {delete}';
}
?>
<div class="security-cameras-index box box-primary">
    <div class="box-header with-border">
    <?php  if (\Yii::$app->user->can('/security-cameras/create') || \Yii::$app->user->can('/*')) :  ?> 
        <?= Html::a('<i class="flaticon-add" style="font-size: 20px"></i> '.'Crear camara de seguridad', ['create'], ['class' => 'btn btn-primary']) ?>
    <?php  endif;  ?> 
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                [
                    'attribute' => 'housing_estate_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->housingEstate->name;
                    },
                    'filter' => yii\helpers\ArrayHelper::map(
                            \app\models\HousingEstate::find()                                    
                                    ->where(['active' => 1])
                                    ->all()
                            , 'id', 'name')
                ],
                'name',
                'camera_ip',
                'code',
                [
                    'attribute' => 'active',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Yii::$app->utils->getConditional($data->active);
                    },
                    'filter' => Yii::$app->utils->getFilterConditional()
                ],
                // 'created',
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
