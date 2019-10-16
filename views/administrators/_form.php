<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Administrators */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="administrators-form box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/administrators/index') || \Yii::$app->user->can('/*')) : ?>        
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
                $dataList = yii\helpers\ArrayHelper::map(\app\models\HousingEstate::find()->orderBy('name ASC')->where(['housing_estate.active' => 1])->all(), 'id', 'name');
                ?>
                <?=
                $form->field($model, 'housing_estate_id')->dropDownList($dataList,
                        ['prompt' => '- Seleccione una unidad residencial -']);
                ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="row-field">
                <?= $form->field($model, 'cellphone')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="row-field">
                <?= $form->field($model, 'startdate')->textInput() ?>

                <?= $form->field($model, 'enddate')->textInput() ?>
            </div>
            <div class="row-field">
                <?= $form->field($model, 'active')->dropDownList(Yii::$app->utils->getFilterConditional()); ?>
            </div>
            <div class="row-field">                
                <?=
                $form->field($model, 'file')->widget(FileInput::classname(), [
                    'pluginOptions' => [
                        'showUpload' => false,
                        'showPreview' => false
                    ],
                    'options' => ['accept' => 'image/*'],
                ]);
                ?>    
                <?php if (!empty($model->photo)): ?>
                    <div class="form-group col-md-6">
                        <?= yii\bootstrap\Html::img($model->photo, ['style' => 'width:100px;']); ?>
                    </div>
                <?php endif; ?>
            </div>



        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
