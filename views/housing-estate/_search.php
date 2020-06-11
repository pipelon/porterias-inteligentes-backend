<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HousingEstateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="housing-estate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'location') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'phone_number') ?>

    <?php // echo $form->field($model, 'police_phone_number') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'neighborhood') ?>

    <?php // echo $form->field($model, 'security_guard_id') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'modified_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
