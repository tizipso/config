<?php

namespace Dcat\Admin\Extension\Config;

use Dcat\Admin\Extension;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class Config extends Extension
{
    const NAME = 'config';

    protected $serviceProvider = ConfigServiceProvider::class;

    protected $composer = __DIR__.'/../composer.json';

    protected $assets = __DIR__.'/../resources/assets';

    protected $views = __DIR__.'/../resources/views';

//    protected $lang = __DIR__.'/../resources/lang';

    protected $migrations = __DIR__.'/../database/migrations';

    protected $menu = [
        'title' => 'Config',
        'path'  => 'config',
        'icon'  => 'fa-sliders',
    ];

    public function import(Command $command)
    {
        parent::import($command);

        $table = config('admin.extensions.config.table', 'admin_config');

        if (Schema::hasTable($table)) {
            $command->error('数据库存在'.$table.'表，请删除数据表后重试');
        }

        Artisan::call('migrate');

        $command->info('导入成功');
    }
}
