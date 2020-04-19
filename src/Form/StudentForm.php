<?php

namespace  \Drupal\studentapi\Form;

use \Drupal\Core\Form\FormBase;
use  \Drupal\Core\Form\FormStateInterface;


class StudentForm extends FormBase {

    /**
     * Implement the studnt form
     */

    public function getFormId()
    {
        // TODO: Implement getFormId() method.
        return 'student_form';
    }

    /**
     * {@inheritdoc}
     */

     public function buildForm(array $form, FormStateInterface $form_state)
     {
         // TODO: Implement buildForm() method.

         $form['std_first_name'] = [
           '#title' => $this->t('First Name'),
           '#type' => 'text_format',
           '#default_value' => '',
         ];
         $form['std_last_name'] = [
             '#title' => $this->t('Last Name'),
             '#type' => 'text_format',
             '#default_value' => '',
         ];
         $form['std_mail'] = [
             '#title' => $this->t('Email Address'),
             '#type' => 'email',
             '#default_value' => '',
         ];
         //select options

           $programms = ['phd'=> 'PHD', 'mba'=> 'MBA', 'mca' => 'MCA', 'bca'=>'BCA', 'bba'=>'BBA', 'nsfr' => 'NSFR'];

           $form['program'] = [
               '#title' => $this->t(''),
               '#type' => 'select',
               '#options' => $programms,
               '#default_value' => '',
           ];
         $status = array(0=>)
         $form['active'] = array(
             '#type' => 'radios',
             '#title' => t('Status'),
             '#default_value' => isset($node->active) ? $node->active : 1,
             '#options' => $active,
             '#description' => t('When a poll is closed, visitors can no longer vote for it.'),
             '#acces

         return $form;
     }


}