<style>
    table {
        margin: 0px;
        width: 100%;
    }
    table th, table td{
        padding: 5px;
    }
    table th {
        text-align: left;
    }
</style>

<p>Вас назначили менеджером ресторана на сайте Prines.ru</p>
<p>Данные для входа:</p>
<p>Адрес <strong><a href="<?php echo Yii::app()->params['hostname'].'/admin' ?>"><?php echo Yii::app()->params['hostname'].'/admin' ?></a></strong></p>
<p>Логин <strong><?php echo $model->email ?></strong></p>
<p>Пароль <strong><?php echo $password ?></strong></p>