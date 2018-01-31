<?php

namespace CA\PersoBundle\Serializer\Listener;

use CA\PersoBundle\Entity\Perso;
use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;


class PersoListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            array(
                'event' => 'serializer.post_serialize',
                'format' => 'json',
                'class' => Perso::class,
                'method' => 'onPostSerialize'),
        );
    }

    public static function onPostSerialize(ObjectEvent $event)
    {
        // Possibilité de récupérer l'objet qui a été sérialisé
        $object = $event->getObject();

        $date = new \Datetime();
        // Possibilité de modifier le tableau après sérialisation
        $event->getVisitor()->addData('serialized_at', $date->format('l jS \of F Y h:i:s A'));
    }
}