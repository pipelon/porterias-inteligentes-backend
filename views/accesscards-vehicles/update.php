<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AccesscardsVehicles */

$this->title = 'Actualizar: ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Tarjetas de acceso vehicular', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->code]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="accesscards-vehicles-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
