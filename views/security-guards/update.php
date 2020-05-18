<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SecurityGuards */

$this->title = 'Actualizar Security Guards: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Security Guards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="security-guards-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
