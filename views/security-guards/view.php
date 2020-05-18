<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SecurityGuards */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Security Guards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="security-guards-view box box-primary">
    <div class="box-header">
        <?php  if (\Yii::$app->user->can('/security-guards/index') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> '.'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php  endif;  ?> 
        <?php  if (\Yii::$app->user->can('/security-guards/update') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-edit-1" style="font-size: 20px"></i> '.'Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php  endif;  ?> 
        <?php  if (\Yii::$app->user->can('/security-guards/delete') || \Yii::$app->user->can('/*')) :  ?>        
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
        <?php
        $housing_estates = [];
        
        $housing_estates2 = \app\models\HousingEstateSecurityGuard::find()      
                ->select('housing_estate.name')
                ->innerJoin('housing_estate', 'housing_estate.id = housing_estate_security_guard.housing_estate_id')
                ->where(['housing_estate_security_guard.security_guard_id' => $model->id])
                ->asArray()
                ->all();
        
        foreach ($housing_estates2 as $value) {
            $housing_estates[] = $value['name'];
        }
        ?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'user_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        $portero = app\models\Users::find()
                                ->where(['id' => $data->user_id])
                                ->one();
                        return $portero->name;
                    },
                ],
                [
                    'attribute' => 'housing_estates',
                    'format' => 'raw',
                    'value' => function ($data) use ($housing_estates) {
                        return implode("<br />", $housing_estates);
                    },
                ],
                [
                    'attribute' => 'active',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Yii::$app->utils->getConditional($data->active);
                    },
                ],
                'created',
                'created_by',
                'modified',
                'modified_by'
            ],
        ]) ?>
    </div>
</div>
