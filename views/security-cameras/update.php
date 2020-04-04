<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SecurityCameras */

$this->title = 'Actualizar Cámaras de seguridad: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cámaras de seguridad', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="security-cameras-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
