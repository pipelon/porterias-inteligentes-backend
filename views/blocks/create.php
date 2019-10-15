<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Blocks */

$this->title = 'Crear Bloque';
$this->params['breadcrumbs'][] = ['label' => 'Bloques', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blocks-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
