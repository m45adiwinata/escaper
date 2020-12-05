<?php

namespace App\Admin\Controllers;

use App\ViewContact;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ContactController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ViewContact';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ViewContact());

        $grid->column('id', __('Id'));
        $grid->column('email', __('Email'));
        $grid->column('instagram', __('Instagram'));
        $grid->column('address', __('Address'));
        $grid->column('lat', __('Lat'));
        $grid->column('lng', __('Lng'));
        $grid->column('link', __('Link'));
        $grid->column('status', __('Status'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(ViewContact::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('email', __('Email'));
        $show->field('instagram', __('Instagram'));
        $show->field('address', __('Address'));
        $show->field('lat', __('Lat'));
        $show->field('lng', __('Lng'));
        $show->field('link', __('Link'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ViewContact());

        $form->email('email', __('Email'));
        $form->text('instagram', __('Instagram'));
        $form->textarea('address', __('Address'));
        $form->decimal('lat', __('Lat'));
        $form->decimal('lng', __('Lng'));
        $form->textarea('link', __('Link'));
        $form->switch('status', __('Status'))->default(1);

        return $form;
    }
}
