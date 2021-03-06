<?php

namespace CA\PersoBundle\Controller;

use CA\PersoBundle\Entity\Friendship;
use CA\PersoBundle\Entity\Nourriture;
use CA\PersoBundle\Entity\Perso;
use CA\PersoBundle\Repository\FamilleRepository;
use CA\PersoBundle\Repository\NourritureRepository;
use JMS\Serializer\SerializationContext;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class PersoController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $persos = $em->getRepository('CAPersoBundle:Perso')->findAll();
        return $this->render('CAPersoBundle:Perso:index.html.twig', array("persos" => $persos));
    }

    public function viewAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $perso = $em->getRepository('CAPersoBundle:Perso')->find($id);
        return $this->render('CAPersoBundle:Perso:view.html.twig', array("perso" => $perso));
    }
    public function editAction($id, Request $request)
    {
        if($this->getUser() and $this->getUser()->getId() == $id)
        {
            $em = $this->getDoctrine()->getManager();
            $oldPerso = $em->getRepository('CAPersoBundle:Perso')->find($id);
            $newPerso = new Perso();
            $form = $this->createFormBuilder($newPerso)
                ->add('age', IntegerType::class)
                ->add('famille', EntityType::class, array(
                    'class'        => 'CAPersoBundle:Famille',
                    'choice_label' => 'name',
                    'multiple'     => false,
                    'expanded'     => false))
                ->add('race', TextType::class)
                ->add('nourriture', EntityType::class, array(
                    'class'         => 'CAPersoBundle:Nourriture',
                    'choice_label'  => 'name',
                    'multiple'      => true,
                    'expanded'      => false,
                ))
                ->add('save', SubmitType::class, array('label' => 'EDIT/CREATE'))
                ->getForm();
            
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $newPerso = $form->getData();
                $oldPerso->setRace($newPerso->getRace());

                foreach($newPerso->getNourriture() as $nourriture)
                {
                    $oldPerso->addNourriture($nourriture);
                }
                $oldPerso->setAge($newPerso->getAge());
                $oldPerso->setFamille($newPerso->getFamille());
                $em->persist($oldPerso);
                $em->flush();
                $request->getSession()->getFlashBag()->add("edit/create", "voila une nouvelle edition");
                return $this->redirectToRoute('ca_perso_view', array('id' => $oldPerso->getId()));
            }
            return $this->render('CAPersoBundle:Perso:edit.html.twig', array('form' => $form->createView(), "oldPerso" => $oldPerso));
        }
        return $this->redirectToRoute('homepage');
    }


    public function addRemoveFriendAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $friend = $em->getRepository('CAPersoBundle:Perso')->find($id);

        if($this->getUser()->hasFriend($friend))
        {
            $this->getUser()->removeMyFriend($friend);
            $em->flush();
        }
        elseif ($friend->hasFriend($this->getUser()))
        {
            $friend->removeMyFriend($this->getUser());
            $em->flush();
        }
        else
        {
            $this->getUser()->addMyFriend($friend);
            $em->flush();
        }

        return $this->redirectToRoute('homepage');
    }

    public function searchAction()
    {
        return $this->render('CAPersoBundle:Perso:search.html.twig');
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $perso = $em->getRepository('CAPersoBundle:Perso')->find($id);
        $data = $this->get('jms_serializer')->serialize($perso, 'json', SerializationContext::create()->setGroups(array('show')));
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function listAction()
    {
        $persos = $this->getDoctrine()->getRepository('CAPersoBundle:Perso')->findAll();
        $data = $this->get('jms_serializer')->serialize($persos, 'json', SerializationContext::create()->setGroups(array('list')));
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
