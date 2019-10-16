<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Administrators */

$this->title = 'Actualizar: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Administradores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="administrators-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
