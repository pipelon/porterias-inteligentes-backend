<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Blocks */

$this->title = 'Actualizar Bloque: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bloques', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="blocks-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
