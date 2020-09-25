<?php

namespace Dcat\Admin\Extension\Config\Http\Forms;

use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Contracts\LazyRenderable;

use Symfony\Component\HttpFoundation\Response;

class Config extends Form implements LazyRenderable
{
    use LazyWidget;

    // 处理表单提交请求
    public function handle(array $input)
    {
        $id = $this->payload['id'] ?? null;

        // dump($input);

        // return $this->error('Your error message.');

        return $this->success('Processed successfully.', '/');
    }

    // 构建表单
    public function form()
    {
        $id = $this->payload['id'] ?? null;

        // Since v1.6.5 弹出确认弹窗
        $this->confirm('您确定要提交表单吗', 'content');

        $this->text('name')->required();
        $this->email('email')->rules('email');
    }

    /**
     * 返回表单数据，如不需要可以删除此方法
     *
     * @return array
     */
    public function default()
    {
        return [
            'name'  => 'John Doe',
            'email' => 'John.Doe@gmail.com',
        ];
    }
}
