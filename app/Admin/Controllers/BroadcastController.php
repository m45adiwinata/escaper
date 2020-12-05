<?php

namespace App\Admin\Controllers;

use App\Broadcast;
use App\Subscriber;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Mail;

class BroadcastController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Broadcast';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Broadcast());

        $grid->column('id', __('Id'));
        $grid->column('subject', __('Subject'));
        $grid->column('text', __('Text'));
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
        $show = new Show(Broadcast::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('subject', __('Subject'));
        $show->field('text', __('Text'));
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
        $form = new Form(new Broadcast());

        $form->textarea('subject', __('Subject'));
        $form->textarea('text', __('Text'));

        $form->saved(function (Form $form) {
            $data = Broadcast::find($form->model()->id);
            $subscribers = Subscriber::get();
            foreach ($subscribers as $subscriber) {
                $temp = array(
                    'email' => $subscriber->email,
                    'subject' => $data->subject,
                    'text' => $data->text,
                    'id' => $data->id
                );
                Mail::send('emailbc', $temp, function($message) use ($temp) {
                    $message->to($temp['email']);
                    $message->from('info.escaper@gmail.com');
                    $message->subject($temp['subject']);
                });
            }
        });

        return $form;
    }
}
