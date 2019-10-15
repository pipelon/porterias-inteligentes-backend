<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ApartmentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apartments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'block_id') ?>

    <?= $form->field($model, 'floor') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'phone_number_1') ?>

    <?php // echo $form->field($model, 'phone_number_2') ?>

    <?php // echo $form->field($model, 'cellphone_number_1') ?>

    <?php // echo $form->field($model, 'cellphone_number_2') ?>

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
