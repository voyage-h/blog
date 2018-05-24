<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\models\User;

class UploadController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['avatar','blog'],
                'rules' => [
                    [
                        'actions' => ['save'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionAvatar()
    {
        if ($filename = Yii::$app->request->post('filenames')) {
            $user = User::findOne(Yii::$app->user->id);
            $user->avatar = $filename[0];
            if ($user->save()) {
                return $this->goBack();
            }
            $errors = $user->errors;
        } else {
        

            $model = new UploadForm();
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($filenames = $model->upload()) {
                return "<script>parent.preview('$filenames')</script>";
            }
            $errors = $model->errors;
        }
        dd($errors);
    }

    public function actionBlog()
    {
        $model = new UploadForm();
        $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
        if ($filenames = $model->upload()) {
            return "<script>parent.preview('$filenames')</script>";
        }
        dd($model->errors);
        
    }

}
