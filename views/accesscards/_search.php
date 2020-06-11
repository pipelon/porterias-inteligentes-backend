<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccesscardsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accesscards-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'resident_id') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'active') ?>

    <?= $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'modified_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
