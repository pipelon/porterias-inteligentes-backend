<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Administrators */

$this->title = 'Crear administrator';
$this->params['breadcrumbs'][] = ['label' => 'Administradores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrators-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
