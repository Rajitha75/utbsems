<?php
namespace common\models;
use Yii;
use yii\base\Model;
use Exception;
 
class Storage extends Model
{
    public $user_image;
    public $importfile;

    function __construct() {
    }
  
    public function upload($userid)
    {
        if ($this->validate()) {
            if (!file_exists('../../frontend/web/uploads/profile_images/' . $userid)) {
                mkdir('../../frontend/web/uploads/profile_images/' . $userid, 0755, true);
            }
            $this->user_image->saveAs('../../frontend/web/uploads/profile_images/' . $userid. '/' . $this->user_image->baseName . '.' . $this->user_image->extension);
            return true;
        } else {
            return false;
        }
    } 

    public function uploadExcel()
    {
        if ($this->validate()) {
            if (!file_exists('../../frontend/web/uploads/student-data/')) {
                mkdir('../../frontend/web/uploads/student-data/', 0755, true);
            }
            $this->importfile->saveAs('../../frontend/web/uploads/student-data/'. $this->importfile->baseName . '.' . $this->importfile->extension);
            return true;
        } else {
            return false;
        }
    } 

}