<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Residents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="residents-form box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/residents/index') || \Yii::$app->user->can('/*')) : ?>        
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
                                \app\models\Apartments::find()
                                        ->select([
                                            "id" => "apartments.id",
                                            "unidad" => "housing_estate.name",
                                            "name" => "apartments.name"
                                        ])
                                        ->join('LEFT JOIN', 'housing_estate', 'housing_estate_id = housing_estate.id')
                                        ->all()
                                , 'id', 'name', 'unidad');
                ?>

                <?=
                $form->field($model, 'apartment_id')->widget(Select2::classname(), [
                    'data' => $dataList,
                    'options' => ['placeholder' => '- Seleccione un apartamento -'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>                

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="row-field">
                <?= $form->field($model, 'sex')->dropDownList(Yii::$app->params['sex'], ['prompt' => '- Seleccione un sexo -']) ?>

                <?= $form->field($model, 'document_type')->dropDownList(Yii::$app->params['document_type'], ['prompt' => '- Seleccione un tipo de documento -']) ?>
            </div>
            <div class="row-field">
                <?= $form->field($model, 'document')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="row-field">
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                <?php //= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>           
                <?=
                $form->field($model, 'tags')->widget(pudinglabs\tagsinput\TagsinputWidget::classname(), [
                    'options' => [],
                    'clientOptions' => [],
                    'clientEvents' => []
                ]);
                ?>
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
                        <?= yii\bootstrap\Html::img('@web/' . $model->photo, ['style' => 'width:100px;']); ?>
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
