<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Accesscards */

$this->title = 'Actualizar tarjeta: ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Tarjetas de acceso', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->code]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="accesscards-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
