<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\SecurityGuards */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="security-guards-form box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/security-guards/index') || \Yii::$app->user->can('/*')) : ?>        
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
                $dataList2 = yii\helpers\ArrayHelper::map(
                                \app\models\Users::find()
                                        ->innerJoin('auth_assignment', 'auth_assignment.user_id = users.id')
                                        ->where(['users.active' => 1, 'auth_assignment.item_name' => 'Portero'])
                                        ->all()
                                , 'id', 'name');
                ?>                
                <?= $form->field($model, 'user_id')->dropDownList($dataList2, ['prompt' => '- Seleccione un portero -']) ?>
                
                <?php
                $dataList = yii\helpers\ArrayHelper::map(
                                \app\models\HousingEstate::find()
                                        ->where(['active' => 1])
                                        ->all()
                                , 'id', 'name');
                ?>
                <?=
                $form->field($model, 'housing_estates')->widget(Select2::classname(), [
                    'data' => $dataList,
                    'options' => [
                        'placeholder' => '- Seleccione las unidades residenciales -',
                        'multiple' => true
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
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
