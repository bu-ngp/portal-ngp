<?php

namespace ngp\bootstrap;

use Yii;
use yii\base\BootstrapInterface;

class Documenter implements BootstrapInterface
{
    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        $container = Yii::$container;

        $container->set('common\widgets\Documenter\Documenter', [
            'directories' => [
                '@ngp/updates_doc',
            ],
        ]);
    }
}