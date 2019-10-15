<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pets */

$this->title = 'Actualizar mascota: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mascotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="pets-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
