<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//panggil master model pegawai
use app\models\Divisi;
use app\models\Jabatan;
use yii\helpers\ArrayHelper; //penggunaan array assosiatif
//panggil master data
$listDivisi = ArrayHelper::map(Divisi::find()->asArray()->all(),'id','nama');
$listJabatan = ArrayHelper::map(Jabatan::find()->asArray()->all(),'id','nama');

//panggil vendor
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pegawai-form">

    <?php// $form = ActiveForm::begin(); ?>
    <?php $form = ActiveForm::begin(
        ['options'=>['enctype'=>'multipart/form-data']]
     ); ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'gender')->dropDownList([ 'L' => 'L', 'P' => 'P', ], ['prompt' => '']) ?> -->
    <?= $form->field($model, 'gender')->radioList([ 'L' => 'L', 'P' => 'P', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir')->textInput() ?>

    <!-- <?= $form->field($model, 'idjabatan')->textInput() ?> -->


    <!-- <?= $form->field($model, 'idjabatan')->dropDownList(
                $listJabatan, 
                ['prompt'=>'-- Pilih Jabatan --']
                ); ?> -->

    <?= $form->field($model, 'idjabatan')->widget(Select2::classname(), [
            'data' => $listJabatan,
            'language' => 'id',
            'options' => ['placeholder' => 'Pilih Jabatan ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <!-- <?= $form->field($model, 'iddivisi')->textInput() ?> -->

    <!-- <?= $form->field($model, 'iddivisi')->dropDownList(
                $listDivisi, 
                ['prompt'=>'-- Pilih Divisi --']
                ); ?> -->
     <?= $form->field($model, 'iddivisi')->widget(Select2::classname(), [
            'data' => $listDivisi,
            'language' => 'id',
            'options' => ['placeholder' => 'Pilih Divisi ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'fotoFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
