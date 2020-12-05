<?php

namespace App\Admin\Controllers;

use App\ProductType;
use App\ProductSize;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductTypeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ProductType';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductType());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('jumlah')->display(function() {
            return count(ProductType::find($this->id)->typedef()->get());
        });

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
        $show = new Show(ProductType::findOrFail($id));

        $show->field('id', __('Id'));
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
        $form = new Form(new ProductType());

        $form->text('name', __('Name'));
        $form->hasMany('typedef', function (Form\NestedForm $form) {
            $form->select('size_init')->options(
                ProductSize::get()->pluck('initial', 'initial')
            );
            $form->text('def_value');
        });

        return $form;
    }
}
