<?php
/**
 * @file
 * Contains \Drupal\test\Form\addForm.
 */
namespace Drupal\test\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityInterface;

class addForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'resume_form_id';
  }
   /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['candidate_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Candidate Name:'),
      // '#required' => TRUE,
    );
    $form['candidate_mail'] = array(
      '#type' => 'email',
      '#title' => t('Email ID:'),
      // '#required' => TRUE,
    );
    $form['candidate_number'] = array (
      '#type' => 'tel',
      '#title' => t('Mobile no'),
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }

   /**
   * {@inheritdoc}
   */
    public function validateForm(array &$form, FormStateInterface $form_state) {

      if (strlen($form_state->getValue('candidate_number')) < 10) {
        $form_state->setErrorByName('candidate_number', $this->t('Mobile number is too short.'));
      }

    }

    /**
   * {@inheritdoc}
   */
// public function submitForm(array &$form, FormStateInterface $form_state) {
//   //  // drupal_set_message($this->t('@can_name ,Your application is being submitted!', array('@can_name' => $form_state->getValue('candidate_name'))));
//   //   foreach ($form_state->getValues() as $key => $value) {
//   //   //   drupal_set_message($key . ': ' . $value);
//   //   }

//   $name = $form_state->getValue('candidate_name');
//   $mail = $form_state->getValue('candidate_mail');
//   $number = $form_state->getValue('candidate_number');

//   echo $name;
//   echo "<br>";
//   echo $mail;
//   echo "<br>";
//   echo $number;
//   echo "<br>";


//   $mailManager = \Drupal::service('plugin.manager.mail');

//   $module = 'test';
//   $key = 'create_page';
//   $to = \Drupal::currentUser()->getEmail();
//   $params['candidate_name'] = $name;
//   $params['candidate_mail'] = $mail;
//   $params['candidate_number'] = $number;
//   $langcode = \Drupal::currentUser()->getPreferredLangcode();
//   $send = true;

//   $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
//   // $result = $mailManager->mail('custom_mail', 'create_page', 'test.test@gmail.com', $langcode, 'test body content', NULL , TRUE);
//   if ($result['result'] !== true) {

//     \Drupal::messenger()->addMessage(t('There was a problem sending your message and it was not sent'),'error');
//     //drupal_set_message(t('There was a problem sending your message and it was not sent.'), 'error');
//   }
//   else {

//     \Drupal::messenger()->addMessage(t('your msg has been sent'),'status');
//    // drupal_set_message(t('Your message has been sent.'));
//   }
//    }
// }

public function submitForm(array &$form, FormStateInterface $form_state){

$name = $form_state->getValue('candidate_name');
$mail = $form_state->getValue('candidate_mail');
$number = $form_state->getValue('candidate_number');


$mailManager = \Drupal::service('plugin.manager.mail');
        $module = 'test';
        $key = 'contact_form'; // Replace with Your key
        $to = $mail;
        $params = array(
            'body' => $name. "---------" . $number,
            'subject' => $mail,
            );
        $langcode = \Drupal::currentUser()->getPreferredLangcode();
        $send = true;



        $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
        if ($result['result'] != true) {
        \Drupal::messenger()->addMessage(t('There was a problem sending your message and it was not sent'),'error');
        return;
        }
        else{
         \Drupal::messenger()->addMessage(t('your msg has been sent'),'status');
        }
}
}