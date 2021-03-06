<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HousingEstateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unidades residenciales';
$this->params['breadcrumbs'][] = $this->title;

$template = '';
if (\Yii::$app->user->can('/housing-estate/view')) {
    $template .= '{view} ';
}
if (\Yii::$app->user->can('/housing-estate/update')) {
    $template .= '{update} ';
}
if (\Yii::$app->user->can('/housing-estate/delete')) {
    $template .= '{delete} ';
}
if (\Yii::$app->user->can('/housing-estate/*') || \Yii::$app->user->can('/*')) {
    $template = '{view}  {update}  {delete}';
}
?>
<div class="housing-estate-index box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/housing-estate/create') || \Yii::$app->user->can('/*')) : ?> 
            <?= Html::a('<i class="flaticon-add" style="font-size: 20px"></i> ' . 'Nueva unidad residencial', ['create'], ['class' => 'btn btn-primary']) ?>
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
                    'attribute' => 'city_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->city->name;
                    },
                    'filter' => yii\helpers\ArrayHelper::map(
                            \app\models\Cities::find()
                                    ->where(['active' => 1])
                                    ->orderBy('name ASC')
                                    ->all()
                            , 'id', 'name')
                ],
                'address',
                'neighborhood',
                [
                    'attribute' => 'security_guard_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->securityGuard->name;
                    },
                    'filter' => yii\helpers\ArrayHelper::map(
                            \app\models\Users::find()
                                    ->innerJoin('auth_assignment', 'auth_assignment.user_id = users.id')
                                    ->where(['users.active' => 1, 'auth_assignment.item_name' => 'Portero'])
                                    ->orderBy('name ASC')
                                    ->all()
                            , 'id', 'name')
                ],
                // 'phone_number',
                // 'police_phone_number',
                // 'city_id',
                // 'neighborhood',
                // 'security_guard_id',
                // 'active',
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
        ]);
        ?>
    </div>
</div>
