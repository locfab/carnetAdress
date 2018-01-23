<?php

namespace CA\PersoBundle\Controller;

use CA\PersoBundle\Entity\Perso;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


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
        $em = $this->getDoctrine()->getManager();
        $oldPerso = $em->getRepository('CAPersoBundle:Perso')->find($id);
        $newPerso = new Perso();
        $form = $this->createFormBuilder($newPerso)
            ->add('age', IntegerType::class)
            ->add('famille', TextType::class)
            ->add('race', TextType::class)
            ->add('nourriture', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newPerso = $form->getData();

            $oldPerso->setRace($newPerso->getRace());
            $oldPerso->setNourriture($newPerso->getNourriture());
            $oldPerso->setAge($newPerso->getAge());
            $oldPerso->setFamille($newPerso->getFamille());
            $em->flush();
            $request->getSession()->getFlashBag()->add("editPost", "voila une nouvelle edition");
            return $this->redirectToRoute('ca_perso_view', array('id' => $oldPerso->getId()));
        }

        return $this->render('CAPersoBundle:Perso:edit.html.twig', array('form' => $form->createView()));
    }
}

/*





        $em = $this->getDoctrine()->getManager();
        $perso = $em->getRepository('CAPersoBundle:Perso')->find($id);

        $form = $this->createFormBuilder(new Perso(),$perso)
            ->add('age', IntegerType::class)
            ->add('famille', TextType::class)
            ->add('race', TextType::class)
            ->add('nourriture', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $perso = $form->getData();
            $em->persist($perso);
            $em->flush();
            $request->getSession()->getFlashBag()->add("editPost", "voila une nouvelle edition");
            return $this->redirectToRoute('ca_perso_view', array('id' => $perso->getId()));
        }

        return $this->render('CAPersoBundle:Post:edit.html.twig', array('form' => $form->createView()));
    }
 */