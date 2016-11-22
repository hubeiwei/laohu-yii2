<?php
namespace app\modules\backend\controllers\base;

use app\common\extensions\MasterController;

class ModuleController extends MasterController
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->layout = '@app/views/layouts/backend';
    }
}
