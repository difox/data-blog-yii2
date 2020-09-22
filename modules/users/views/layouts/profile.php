<?php
    $this->params['breadcrumbs'] = [
        'Профиль',
    ];
?>

<?php $this->beginContent('@app/views/layouts/content.php') ?>

<div class="content-wrap holder">
    <div class="cols-wrap">
      <div class="sidebar">
        <div class="sidebar-section mobile-menu-only">
          <select class="js-select-style">
            <option>Профиль</option>
            <option>Промокоды</option>
            <option>История заказов</option>
          </select>
        </div>
        <div class="sidebar-section profile-sidebar">
          <div class="sidebar-box">
            <ul class="sidebar-menu">
                <li><a class="<?= \Yii::$app->controller->action->id == 'index' ? 'active' : '' ?>" href="/profile">Профиль</a></li>
                <li>
                    <a class="<?= \Yii::$app->controller->action->id == 'promocodes' ? 'active' : '' ?>" href="/profile/promocodes">
                        Промокоды</a><span><?= (int)\Yii::$app->user->identity->getPromocodes()->count() ?: '' ?></span>
                </li>
                <li>
                    <a class="<?= \Yii::$app->controller->action->id == 'history' ? 'active' : '' ?>" href="/profile/history">
                        История заказов<span><?= (int)\Yii::$app->user->identity->getOrders()->count() ?: '' ?></span>
                    </a>
                </li>
            </ul>
          </div>
          <div class="sidebar-box">
            <div class="points">
              <h3>Бонусы</h3>
              <p>На вашем счету сейчас</p>
              <svg>
                <use xlink:href="#icons-15"></use>
              </svg><strong><?= (int)\Yii::$app->user->identity->bonus ?></strong>
            </div>
          </div>
          <div class="sidebar-box">
            <ul class="sidebar-menu">
              <li><a href="/logout">Выйти</a></li>
            </ul>
          </div>
        </div>
        <div class="sidebar-section mobile-only">
          <div class="sidebar-box">
            <div class="points"><span>На вашем счету сейчас</span>
              <svg>
                <use xlink:href="#icons-15"></use>
              </svg><strong>0</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main-content">        
        <?= $content ?>
    </div>
</div>

<?php $this->endContent();