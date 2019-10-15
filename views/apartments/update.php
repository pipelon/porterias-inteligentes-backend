<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Apartments */

$this->title = 'Actualizar apartamento: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Apartamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="apartments-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
