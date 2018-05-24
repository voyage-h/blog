<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFiles;
    public $imageFile;
    public $filename;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => ['jpg', 'jpeg', 'png'],'maxFiles' => 9],
        ];
    }
    
    public function upload()
    {
        if (!$this->validate()) {
            return false;
        }
        foreach ($this->imageFiles as $file) {
            $filename = Yii::$app->getSecurity()->generateRandomString() . '.' . $file->extension;
            $file->saveAs("images/upload/$filename");
            $filenames[] = $filename;
        }
        return json_encode($filenames);
    }
}
