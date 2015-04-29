<?php
/**
 * Created by PhpStorm.
 * User: kaile
 * Date: 06.04.15
 * Time: 0:52
 */

namespace app\models;


use yii\base\Model;
use yii\web\UploadedFile;

class FileUpload extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * Validate rules
     *
     * @return array the validation rules
     */
    public function rules()
    {
        return [
            [['file'], 'file'],
        ];
    }
} 