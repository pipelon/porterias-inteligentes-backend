<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Residents */

$this->title = 'Actualizar: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Residentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="residents-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
