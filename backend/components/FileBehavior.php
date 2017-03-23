<?php
namespace backend\components;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * Class FileBehavior
 * File uploading behavior
 * @package backend\components
 */
class FileBehavior extends Behavior
{
	/** @var string $attr_file name attribute */
	public $attr_file;
	/** @var string $path server directory */
	public $path = 'upload';
    /** @var bool multiple */
    public $multiple = false;

	/**
	 * Path to folder
	 * @return string
	 */
	public function getFileDir()
	{
		return Yii::getAlias('@backend/web/' . $this->path);
	}

    /**
     * Web path to folder
     * @return string
     */
    public function getWebDir()
    {
        return Yii::getAlias('@web/' . $this->path) . '/';
    }

	/**
	 * Events
	 * @return array
	 */
	public function events()
	{
		return [
			ActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeSave',
			ActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeSave'
		];
	}

    /**
     * Init
     */
	public function init()
    {
        if (!is_dir($this->getFileDir()))
            mkdir($this->getFileDir(),0777);
    }

	/**
	 * Before save model
	 */
	public function onBeforeSave()
	{
	    /** @var ActiveRecord $model */
		$model = $this->owner;

        if($this->multiple === true){
            $files = UploadedFile::getInstances($model, $this->attr_file);

            if (!empty($files))
                /** @var UploadedFile $file write files */
                foreach ($files as $file)
                    $this->saveFile($file);

        }else{
            $file = UploadedFile::getInstance($model, $this->attr_file);
            if($this->saveFile($file))
                $model->{$this->attr_file} =  $this->getWebDir(). $file->baseName . '.' . $file->extension;
        }
	}

    /**
     * Save file to server
     * @param UploadedFile $file
     * @return bool
     */
	private function saveFile($file){
	    if(!empty($file))
            return !empty($file->saveAs($this->getFileDir() .'/'. $file->baseName . '.' . $file->extension)) ? true : false;

        return false;
    }
}