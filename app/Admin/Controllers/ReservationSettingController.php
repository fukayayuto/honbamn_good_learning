<?php

namespace App\Admin\Controllers;

use App\Models\ReservationSetting;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReservationSettingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ReservationSetting';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ReservationSetting());

        $grid->column('id', __('Id'));
        $grid->column('start_date', __('Start date'));
        $grid->column('count', __('Count'));
        $grid->column('progress', __('Progress'));
        $grid->column('place', __('Place'));
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
        $show = new Show(ReservationSetting::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('start_date', __('Start date'));
        $show->field('count', __('Count'));
        $show->field('progress', __('Progress'));
        $show->field('place', __('Place'));
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
        $form = new Form(new ReservationSetting());

        $form->date('start_date', __('Start date'))->default(date('Y-m-d'));
        $form->number('count', __('Count'));
        $form->number('progress', __('Progress'));
        $form->number('place', __('Place'));

        return $form;
    }
}
