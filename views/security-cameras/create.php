<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SecurityCameras */

$this->title = 'Crear cámara de seguridad';
$this->params['breadcrumbs'][] = ['label' => 'Cámaras de seguridad', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="security-cameras-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
