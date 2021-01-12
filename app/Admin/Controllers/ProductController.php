<?php

namespace App\Admin\Controllers;

use App\Product;
use App\ProductType;
use App\ProductSize;
use App\ProductId;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\File;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('id', __('Id'));
        $grid->column('product_type_id', __('Type'))->display(function() {
            return $this->type()->first()->name;
        });
        $grid->column('image', __('Image'))->carousel($width=300, $height = 200);
        $grid->column('name', __('Name'));
        $grid->column('desc', __('Desc'));
        $grid->column('discount', __('Discount'));
        $grid->column('discounttype', __('Discount Type'));

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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_type_id', __('Product type id'));
        $show->avatar()->image('image', __('Image'));
        $show->field('name', __('Name'));
        $show->field('desc', __('Desc'));
        $show->field('discount', __('Discount'));
        $show->field('discounttype', __('Discount Type'));
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
        date_default_timezone_set('Asia/Makassar');
        $form = new Form(new Product());
        
        $form->select('product_type_id')->options(
            ProductType::get()->pluck('name', 'id')
        );
        $temp = explode('/', $_SERVER['SCRIPT_URI']);
        if ($temp[count($temp) - 1] == "edit")
        {
            $id = intval($temp[count($temp) - 2]);
        }
        else {
            $id = ProductId::orderBy('created_at', 'desc')->first()->last_id;
            $id++;
        }
        // dd($id);
        $form->multipleImage('image', 'Image')->move('images/products/'.$id)->removable();
        $form->text('name', __('Name'));
        $form->textarea('desc', __('Desc'));
        $form->number('discount', 'Discount');
        $states = [
            'on'  => ['value' => 1, 'text' => 'Regular', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'Percentage', 'color' => 'info'],
        ];
        $form->switch('discounttype', 'Discount Type')->states($states);
        $form->hasMany('availability', function (Form\NestedForm $form) {
            $form->select('size_init')->options(ProductSize::get()->pluck('name', 'initial'));
            $form->currency('IDR', 'IDR')->symbol('Rp');
            $form->currency('USD', 'U$D')->symbol('$');
            $form->number('stocks', 'Stock');
        });

        $form->saved(function (Form $form) {
            if (count(ProductId::where('last_id', $form->model()->id)->get()) < 1)
            {
                $dataId = new ProductId;
                $dataId->last_id = $form->model()->id;
                $dataId->save();
            }
        });
        
        return $form;
    }

}
