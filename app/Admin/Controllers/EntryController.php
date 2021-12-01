<?php

namespace App\Admin\Controllers;

use App\Models\Entry;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EntryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Entry';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Entry());

        $grid->column('id', __('Id'));
        $grid->column('reservation_id', __('Reservation id'));
        $grid->column('user_id', __('User id'));
        $grid->column('count', __('Count'));
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
        $show = new Show(Entry::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('reservation_id', __('Reservation id'));
        $show->field('user_id', __('User id'));
        $show->field('count', __('Count'));
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
        $form = new Form(new Entry());

        $form->number('reservation_id', __('Reservation id'));
        $form->number('user_id', __('User id'));
        $form->number('count', __('Count'));

        return $form;
    }
}
