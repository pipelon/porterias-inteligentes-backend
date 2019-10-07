<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HousingEstate */

$this->title = 'Actualizar Housing Estate: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Housing Estates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="housing-estate-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
