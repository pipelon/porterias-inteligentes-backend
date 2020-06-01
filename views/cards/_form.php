<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Cards */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cards-form box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/cards/index') || \Yii::$app->user->can('/*')) : ?>        
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
                <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                
                <?php
                $dataList = yii\helpers\ArrayHelper::map(
                                \app\models\Residents::find()
                                        ->select([
                                            "id" => "residents.id",
                                            "apartmentname" => "CONCAT(housing_estate.name, ' - ', apartments.name)",
                                            "name" => "residents.name"
                                        ])
                                        ->join('LEFT JOIN', 'apartments', 'residents.apartment_id = apartments.id')
                                        ->join('LEFT JOIN', 'housing_estate', 'apartments.housing_estate_id = housing_estate.id')
                                        ->all()
                                , 'id', 'name', 'apartmentname');
                ?>

                <?=
                $form->field($model, 'resident_id')->widget(Select2::classname(), [
                    'data' => $dataList,
                    'options' => ['placeholder' => '- Seleccione un residente -'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>     
            </div>


            <div class="row-field">
                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'active')->dropDownList(Yii::$app->utils->getFilterConditional()); ?>
            </div>

        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
