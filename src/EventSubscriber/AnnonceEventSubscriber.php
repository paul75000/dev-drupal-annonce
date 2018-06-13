<?php

namespace Drupal\annonce\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Routing\CurrentRouteMatch;
use  Drupal\Core\Messenger\MessengerInterface;

/**
 * Class AnnonceEventSubscriber.
 */
class AnnonceEventSubscriber implements EventSubscriberInterface {

  /**
   * Drupal\Core\Session\AccountProxyInterface definition.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;
  protected $currentRoute;
  protected $messenger;

  /**
   * Constructs a new AnnonceEventSubscriber object.
   */
  public function __construct(AccountProxyInterface $current_user, MessengerInterface $messenger , CurrentRouteMatch $current_route_match) {
    $this->currentUser = $current_user;
    $this->currentRoute = $current_route_match;
    $this->messenger = $messenger;
  }

  /**
   * {@inheritdoc}
   */
  // static function getSubscribedEvents() {
  //   $events['kernel.request'] = [['display_username'], ['display_name']];//ici le second element, apres le egal correspond au nom de nos fonction plus bas
  //   return $events;
  // } cette partie est ok mais j'ai une erreur

  static function getSubscribedEvents() {
    $events['kernel.request'] = ['display_annonce'];//ici le second element, apres le egal correspond au nom de nos fonction plus bas
    return $events;
  }

  // public function display_username(Event $event) {
  //  // ksm($this->currentUser->getAccountName());
  //  // drupal_set_message('Event for @'.$this->currentUser->getDisplayName(), 'status', TRUE);
  //   $this->messenger->add
  // } voir stack vers 17h

  public function display_annonce(Event $event){
    if($this->currentRoute->getRouteName() == 'entity.annonce.canonical'){
      // drupal_set_message('annonce');
      $this->messenger->addmessage('annonce');
    }
  }

}
