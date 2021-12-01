<?php

namespace App\Admin\Controllers;

use App\Models\Account;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AccountController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Account';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Account());

        $grid->column('id', __('Id'));
        $grid->column('family_name', __('Family name'));
        $grid->column('first_name', __('First name'));
        $grid->column('email', __('Email'));
        $grid->column('company_name', __('Company name'));
        $grid->column('sales_office', __('Sales office'));
        $grid->column('phone', __('Phone'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('disp_flag', __('Disp flag'));

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
        $show = new Show(Account::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('family_name', __('Family name'));
        $show->field('first_name', __('First name'));
        $show->field('email', __('Email'));
        $show->field('company_name', __('Company name'));
        $show->field('sales_office', __('Sales office'));
        $show->field('phone', __('Phone'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('disp_flag', __('Disp flag'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Account());

        $form->text('family_name', __('Family name'));
        $form->text('first_name', __('First name'));
        $form->email('email', __('Email'));
        $form->text('company_name', __('Company name'));
        $form->text('sales_office', __('Sales office'));
        $form->mobile('phone', __('Phone'));
        $form->switch('disp_flag', __('Disp flag'));

        return $form;
    }
}
