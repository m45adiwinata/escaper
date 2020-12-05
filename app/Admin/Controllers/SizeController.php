<?php

namespace App\Admin\Controllers;

use App\ProductSize;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SizeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ProductSize';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductSize());

        $grid->column('id', __('Id'));
        $grid->column('initial', __('Initial'));
        $grid->column('name', __('Name'));

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
        $show = new Show(ProductSize::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('initial', __('Initial'));
        $show->field('name', __('Name'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProductSize());

        $form->text('initial', __('Initial'));
        $form->text('name', __('Name'));

        return $form;
    }
}
