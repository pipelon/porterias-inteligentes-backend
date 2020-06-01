<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cards */

$this->title = 'Actualizar tarjeta de acceso: ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Tarjetas de acceso', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->code]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="cards-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
