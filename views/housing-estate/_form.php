<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HousingEstate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="housing-estate-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'neighborhood')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'created')->textInput() ?>

        <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'modified')->textInput() ?>

        <?= $form->field($model, 'modified_by')->textInput(['maxlength' => true]) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
