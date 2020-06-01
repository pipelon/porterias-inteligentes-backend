<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CardsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tarjetas de acceso';
$this->params['breadcrumbs'][] = $this->title;

$template = '';
if (\Yii::$app->user->can('/cards/view')) {
    $template .= '{view} ';
}
if (\Yii::$app->user->can('/cards/update')) {
    $template .= '{update} ';
}
if (\Yii::$app->user->can('/cards/delete')) {
    $template .= '{delete} ';
}
if (\Yii::$app->user->can('/cards/*') || \Yii::$app->user->can('/*')) {
    $template = '{view}  {update}  {delete}';
}
?>
<div class="cards-index box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/cards/create') || \Yii::$app->user->can('/*')) : ?> 
            <?= Html::a('<i class="flaticon-add" style="font-size: 20px"></i> ' . 'Crear tarjeta de acceso', ['create'], ['class' => 'btn btn-primary']) ?>
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
                'code',
                [
                    'attribute' => 'resident_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return '<b>' . $data->resident->apartment->housingEstate->name . ' </b>'
                                .'<b>(' . $data->resident->apartment->name . ')</b>'
                                . ' - ' . $data->resident->name;
                    },
                    'filter' => yii\helpers\ArrayHelper::map(
                                \app\models\Residents::find()
                                        ->select([
                                            "id" => "residents.id",
                                            "apartmentname" => "CONCAT(housing_estate.name, ' - ', apartments.name)",
                                            "name" => "residents.name"
                                        ])
                                        ->join('LEFT JOIN', 'apartments', 'residents.apartment_id = apartments.id')
                                        ->join('LEFT JOIN', 'housing_estate', 'apartments.housing_estate_id = housing_estate.id')
                                        ->all()
                                , 'id', 'name', 'apartmentname')
                ],
                [
                    'attribute' => 'active',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Yii::$app->utils->getConditional($data->active);
                    },
                    'filter' => Yii::$app->utils->getFilterConditional()
                ],
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
        ]);
        ?>
    </div>
</div>
