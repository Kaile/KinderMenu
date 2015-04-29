<?php

namespace app\controllers;

use app\controllers\components\DishImport;
use app\models\FileUpload;
use yii\log\Logger;
use yii\web\Controller;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMenu()
    {
        return $this->render('menu');
    }

    public function actionDishes()
    {
        return $this->render('dishes');
    }

    public function actionDishImport()
    {
        $model = new FileUpload();
        $errorMessage = '';
        $dishImport = null;
        $fileName = '';

        if (\Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {
                try {
                    $filePath = dirname(__DIR__) . '/runtime/cache/' . $model->file->baseName . '.' . $model->file->extension;
                    $model->file->saveAs($filePath);
                    $dishImport = new DishImport($filePath);
                } catch(RuntimeException $e) {
                    $errorMessage = $e->getMessage();
                } catch(\PHPExcel_Reader_Exception $e) {
                    $errorMessage = $e->getMessage();
                }
            }
        }

        return $this->render('dish_import', [
            'model' => $model,
            'fileName' => $fileName,
            'errorMessage' => $errorMessage,
            'importedDishes' => ($dishImport) ? $dishImport->getImportedDishes() : array(),
        ]);
    }
}
