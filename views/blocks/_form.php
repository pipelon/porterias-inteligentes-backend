<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Blocks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blocks-form box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/blocks/index') || \Yii::$app->user->can('/*')) : ?>        
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

            <?php
            $dataList = yii\helpers\ArrayHelper::map(\app\models\HousingEstate::find()->orderBy('name ASC')->where(['housing_estate.active' => 1])->all(), 'id', 'name');
            ?>
            <?=
            $form->field($model, 'housing_estate_id')->dropDownList($dataList,
                    ['prompt' => '- Seleccione una unidad residencial -']);
            ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
