<?php

namespace Dcat\Admin\Extension\Config\Http\Controllers;

use Dcat\Admin\Extension\Config\Http\Models\Config;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index(Content $content)
    {
        $grid = new Grid(new Config());

        $grid->id('ID')->sortable();
        $grid->name()->display(function ($name) {
            return "<span class=\"badge badge-primary\">$name</span>";
        });
        $grid->column('value', __('admin.value'));
        $grid->column('description', __('admin.description'));

        $grid->disableEditButton();
        $grid->showQuickEditButton();
        $grid->disableViewButton();
        $grid->enableDialogCreate();
        $grid->tableCollapse(false);

        return $content->title('Config')
            ->body($grid);
    }

    public function editor($id, Content $content)
    {
        // dd($id);
        $Config = new Config();

        // $Config->id = $id;

        $config = $Config->find($id);

        $form = new Form($Config);

        $form->text('name')->value($config->name)->required()->rules('required|min:3|alpha|max:20');
        $form->textarea('value')->value($config->value)->required();
        $form->textarea('description')->value($config->description);
        
        return "<style>.form-editor .row{ margin-right:0; margin-left:0; }</style><section class=\"form-editor\">{$form->render()}</section>";
    }

    public function create(Content $content)
    {
        $form = new Form(new Config);

        $form->text('name')->required()->rules('required|min:3|alpha|max:20');
        $form->textarea('value')->required();
        $form->textarea('description');
        
        $form->disableFooter();

        return "<style>.form-editor .row{ margin-right:0; margin-left:0; }</style><section class=\"form-editor\">{$form->render()}</section>";
    }

    protected function toCreate(Request $request)
    {
        $Config = new Config();

        $Config->name = $request->input('name');
        $Config->value = $request->input('value');
        $Config->description = $request->input('description');

        $Config->save();

        $form = new Form();

        if (!$Config->id) {
            return $form->error('配置信息保存失败');
        }

        return $form->success('配置信息保存成功');
    }

    protected function toEditor($id, Request $request)
    {
        $form = new Form();

        $Config = new Config();

        // $Config->id = $id;

        $Config = $Config->find($id);

        // dd($Config);
        if (!$Config->id) {
            return $form->error('配置信息更新失败');
        }

        $Config->name = $request->input('name');
        $Config->value = $request->input('value');
        $Config->description = $request->input('description');

        $Config->save();

        if (!$Config->id) {
            return $form->error('配置信息更新失败');
        }

        return $form->success('配置信息保存成功');
    }

    protected function toDelete($id, Request $request)
    {
        $form = new Form();

        $Config = new Config();

        $Config = $Config->find($id);

        if (!$Config->id) {
            return $form->error('配置信息删除失败');
        }

        $affected = $Config->delete();

        if ($affected <= 0) {
            return $form->error('配置信息删除失败');
        }

        return $form->success('配置信息删除成功');
    }
}
