<?php

use app\modules\core\helpers\UserHelper;
use app\modules\core\widget\Alert;
use kartik\sidenav\SideNav;
use mdm\admin\components\MenuHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/**
 * @var $this \yii\web\View
 * @var $content string
 */

$css = <<<CSS
.container {
    width: 100%;
}
CSS;

$this->registerCss($css);

$this->beginContent('@app/views/layouts/master.php');

$assignedMenu = MenuHelper::getAssignedMenu(UserHelper::getUserId());

NavBar::begin([
    'brandLabel' => Yii::$app->name . '后台',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => $assignedMenu,
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => '返回前台', 'url' => ['/frontend']],
        ['label' => '登出(' . UserHelper::getUserName() . ')', 'url' => ['/logout']],
    ],
]);

NavBar::end();
?>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-lg-2 hidden-sm hidden-xs">
            <?= SideNav::widget([
                'items' => $assignedMenu,
            ]); ?>
        </div>
        <div class="col-md-9 col-lg-10">
            <?php
            echo Breadcrumbs::widget([
                'homeLink' => [
                    'label' => '首页',
                    'url' => ['/backend'],
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]);

            // 输出消息
            echo Alert::widget();

            echo $content;
            ?>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>
