<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pets */

$this->title = 'Crear mascota';
$this->params['breadcrumbs'][] = ['label' => 'Mascotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pets-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
