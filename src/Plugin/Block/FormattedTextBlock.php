<?php

namespace Drupal\extra_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'FormattedTextBlock' block.
 *
 * @Block(
 *  id = "extra_blocks_formatted_text_block",
 *  admin_label = @Translation("Formatted text block"),
 * )
 */
class FormattedTextBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['text'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Text to display'),
      '#format' => isset($this->configuration['format']) ? $this->configuration['format'] : NULL,
      '#default_value' => isset($this->configuration['text']) ? $this->configuration['text'] : '',
      '#weight' => '5',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['text'] = $form_state->getValue('text')['value'];
    $this->configuration['format'] = $form_state->getValue('text')['format'];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#type' => 'markup',
      '#markup' => $this->configuration['text'],
    );
  }

}
