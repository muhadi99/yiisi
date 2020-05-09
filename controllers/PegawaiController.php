<?php

namespace app\controllers;

use Yii;
use app\models\Pegawai;
use app\models\PegawaiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

//tambahan
use yii\web\UploadedFile;

/**
 * PegawaiController implements the CRUD actions for Pegawai model.
 */
class PegawaiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pegawai models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pegawai model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pegawai model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new Pegawai();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionCreate()
    {
         $model = new Pegawai();
         if ($model->load(Yii::$app->request->post()) && $model->save()) {
         //-----proses awal upload file-------------
         $model->fotoFile = UploadedFile::getInstance($model, 'fotoFile');
         if($model->validate() && !empty($model->fotoFile))
         {
             //simpan nama file foto dgn nip dan extension file yg diupload
             $nama = $model->nip.'.'.$model->fotoFile->extension;
             //simpan nama file foto ke field foto pada model
             $model->foto = $nama;
             //simpan semua data2 ke model Pegawai
             $model->save();
             //simpan fisik gambar ke folder images
             $model->fotoFile->saveAs('images/'.$nama);
         }
         else{
            $model->save();
         }
         //--------proses akhir upload file-----------
         return $this->redirect(['view', 'id' => $model->id]);
         }
         return $this->render('create', [
         'model' => $model,
         ]);
     }

    /**
     * Updates an existing Pegawai model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        /*
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        */
        //fungsi update foto
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
         //-----proses awal upload file-------------
         $model->fotoFile = UploadedFile::getInstance($model, 'fotoFile');
         if($model->validate() && !empty($model->fotoFile))
         {
             //simpan nama file foto dgn nip dan extension file yg diupload
             $nama = $model->nip.'.'.$model->fotoFile->extension;
             //simpan nama file foto ke field foto pada model
             $model->foto = $nama;
             //simpan semua data2 ke model Pegawai
             $model->save();
             //simpan fisik gambar ke folder images
             $model->fotoFile->saveAs('images/'.$nama);
         }
         else{
            $model->save();
         }
         //--------proses akhir upload file-----------
         return $this->redirect(['view', 'id' => $model->id]);
         }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pegawai model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        //hapus dulu file gambar difolder images
        $model = $this->findModel($id);
        unlink('images/'.$model->foto);
        $model->delete(); // hapus semua data

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pegawai model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pegawai the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pegawai::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
