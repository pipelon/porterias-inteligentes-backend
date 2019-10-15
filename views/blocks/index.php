<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BlocksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bloques/Torres/Cuadras';
$this->params['breadcrumbs'][] = $this->title;

$template = '';
if (\Yii::$app->user->can('/blocks/view')) {
    $template .= '{view} ';
}
if (\Yii::$app->user->can('/blocks/update')) {
    $template .= '{update} ';
}
if (\Yii::$app->user->can('/blocks/delete')) {
    $template .= '{delete} ';
}
if (\Yii::$app->user->can('/blocks/*') || \Yii::$app->user->can('/*')) {
    $template = '{view}  {update}  {delete}';
}
?>
<div class="blocks-index box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/blocks/create') || \Yii::$app->user->can('/*')) : ?> 
            <?= Html::a('<i class="flaticon-add" style="font-size: 20px"></i> ' . 'Crear bloque', ['create'], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?> 
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                'name',
                [
                    'attribute' => 'housing_estate_id',
                    'format' => 'raw',
                    'value' => function ($data) {            
                        return $data->housingEstate->name;
                    },
                    'filter' => yii\helpers\ArrayHelper::map(\app\models\HousingEstate::find()->orderBy('name ASC')->where(['housing_estate.active' => 1])->all(), 'id', 'name')
                ],
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
        ]);
        ?>
    </div>
</div>
