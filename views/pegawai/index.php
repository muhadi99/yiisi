<?php

use yii\helpers\Html;
use yii\grid\GridView;

//panggil master model / tabel referensi dari tabel pegawai 
use app\models\Jabatan; 
use app\models\Divisi; 
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pegawai';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pegawai', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nip',
            'nama',
            'gender',
            //'tempat_lahir',
            //'tanggal_lahir',
            //'idjabatan',
            [ 
                'attribute'=>'idjabatan', //foreign key 
                'value'=>'idjabatan0.nama', //nama relasi dimodel 
                'filter'=>ArrayHelper::map(Jabatan::find()-> all(),'id','nama'), 
            ],

            //'iddivisi',
            [ 
                'attribute'=>'iddivisi', //foreign key 
                'value'=>'iddivisi0.nama', //nama relasi dimodel 
                'filter'=>ArrayHelper::map(Divisi::find()-> all(),'id','nama'), 
            ],

            //'alamat:ntext',
            'email:email',
            //'foto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
