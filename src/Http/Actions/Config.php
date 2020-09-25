<?php

namespace Dcat\Admin\Extension\Config\Http\Actions;

use Dcat\Admin\Extension\Config\Http\Forms\Config as ConfigForm;
use Dcat\Admin\Widgets\Modal;
use Dcat\Admin\Grid\RowAction;

class Config extends RowAction
{
    protected $title = '修改密码';

    public function render()
    {
        // 实例化表单类并传递自定义参数
        $form = ConfigForm::make()->payload(['id' => $this->getKey()]);

        return Modal::make()
            ->lg()
            ->title($this->title)
            ->body($form)
            ->button($this->title);
    }
}

