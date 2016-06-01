<?php

namespace Drupal\extra_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'SimpleTextBlock' block.
 *
 * @Block(
 *  id = "extra_blocks_simple_text_block",
 *  admin_label = @Translation("Simple text block"),
 * )
 */
class SimpleTextBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Text to display'),
      '#description' => $this->t('The text to display. 255 characters maximum.'),
      '#default_value' => isset($this->configuration['text']) ? $this->configuration['text'] : '',
      '#maxlength' => 255,
      '#size' => 60,
      '#weight' => '5',
    );
    $form['html_element'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('HTML element'),
      '#description' => $this->t('The HTML element that wraps the simple text. Do not include the &lt; or &gt; symbols.'),
      '#default_value' => isset($this->configuration['html_element']) ? $this->configuration['html_element'] : 'p',
      '#maxlength' => 15,
      '#size' => 15,
      '#weight' => '6',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['text'] = $form_state->getValue('text');
    $this->configuration['html_element'] = $form_state->getValue('html_element');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $el = $this->configuration['html_element'];
    $text = $this->configuration['text'];

    return array(
      '#markup' => "<$el>" . $text . "</$el>",
    );
  }

}
