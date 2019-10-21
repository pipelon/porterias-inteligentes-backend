<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cities */

$this->title = 'Actualizar ciudad: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ciudades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actuallizar';
?>
<div class="cities-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
