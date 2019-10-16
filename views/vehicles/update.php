<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vehicles */

$this->title = 'Actualizar vehículo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vehículo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="vehicles-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
