<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Apartments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apartments-form box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/apartments/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
    </div>
    <?php
    $form = ActiveForm::begin(
                    [
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{hint}\n{error}\n",
                            'options' => ['class' => 'form-group col-md-6'],
                            'horizontalCssClasses' => [
                                'label' => '',
                                'offset' => '',
                                'wrapper' => '',
                                'error' => '',
                                'hint' => '',
                            ],
                        ],
                    ]
    );
    ?>
    <div class="box-body table-responsive">

        <div class="form-row">

            <div class="row-field">
                <?php
                $dataList = yii\helpers\ArrayHelper::map(
                                \app\models\HousingEstate::find()
                                        ->where(['active' => 1])
                                        ->all()
                                , 'id', 'name');
                ?>
                <?= $form->field($model, 'housing_estate_id')->dropDownList($dataList, ['prompt' => '- Seleccione una unidad residencial -']) ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="row-field">
                <?= $form->field($model, 'block')->textInput() ?>
                
                <?= $form->field($model, 'floor')->textInput() ?>
                
            </div>
            <div class="row-field">
                <?= $form->field($model, 'phone_number_1')->textInput(['maxlength' => true]) ?>
                
                <?= $form->field($model, 'phone_number_2')->textInput(['maxlength' => true]) ?>                
            </div>
            <div class="row-field">
                <?= $form->field($model, 'cellphone_number_1')->textInput(['maxlength' => true]) ?>
                
                <?= $form->field($model, 'cellphone_number_2')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="row-field">
                <?= $form->field($model, 'active')->dropDownList(Yii::$app->utils->getFilterConditional()); ?>
            </div>

        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
