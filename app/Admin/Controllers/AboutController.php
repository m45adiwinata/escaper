<?php

namespace App\Admin\Controllers;

use App\ViewAbout;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AboutController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ViewAbout';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ViewAbout());

        $grid->column('id', __('Id'));
        $grid->column('text1', __('Text1'));
        $grid->column('text2', __('Text2'));
        $grid->column('text3', __('Text3'));
        $grid->column('text4', __('Text4'));
        $grid->column('background', __('Background'))->image();
        $grid->column('status', __('Status'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ViewAbout::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('text1', __('Text1'));
        $show->field('text2', __('Text2'));
        $show->field('text3', __('Text3'));
        $show->field('text4', __('Text4'));
        $show->field('background', __('Background'));
        $show->field('status', __('Status'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        date_default_timezone_set('Asia/Makassar');
        $form = new Form(new ViewAbout());

        $form->textarea('text1', __('Text1'));
        $form->textarea('text2', __('Text2'));
        $form->textarea('text3', __('Text3'));
        $form->textarea('text4', __('Text4'));
        $form->image('background', __('Background'))->move('images/background/about')->removable();
        $form->switch('status', __('Status'))->default(1);

        return $form;
    }
}
