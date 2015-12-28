<?php

namespace CursoWorkoutBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CursoWorkoutBundle\Entity\Workout;
use CursoWorkoutBundle\Form\WorkoutType;

/**
 * Workout controller.
 *
 * @Route("/workout")
 */
class WorkoutController extends Controller
{
    /**
     * Lists all Workout entities.
     *
     * @Route("/", name="workout_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $workouts = $em->getRepository('CursoWorkoutBundle:Workout')->findAll();

        return $this->render('workout/index.html.twig', array(
            'workouts' => $workouts,
        ));
    }

    /**
     * Creates a new Workout entity.
     *
     * @Route("/new", name="workout_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $workout = new Workout();
        $form = $this->createForm(new WorkoutType(), $workout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($workout);
            $em->flush();

            return $this->redirectToRoute('workout_show', array('id' => $workout->getId()));
        }

        return $this->render('workout/new.html.twig', array(
            'workout' => $workout,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Workout entity.
     *
     * @Route("/{id}", name="workout_show")
     * @Method("GET")
     */
    public function showAction(Workout $workout)
    {
        $deleteForm = $this->createDeleteForm($workout);

        return $this->render('workout/show.html.twig', array(
            'workout' => $workout,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Workout entity.
     *
     * @Route("/{id}/edit", name="workout_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Workout $workout)
    {
        $deleteForm = $this->createDeleteForm($workout);
        $editForm = $this->createForm(new WorkoutType(), $workout);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($workout);
            $em->flush();

            return $this->redirectToRoute('workout_edit', array('id' => $workout->getId()));
        }

        return $this->render('workout/edit.html.twig', array(
            'workout' => $workout,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Workout entity.
     *
     * @Route("/{id}", name="workout_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Workout $workout)
    {
        $form = $this->createDeleteForm($workout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($workout);
            $em->flush();
        }

        return $this->redirectToRoute('workout_index');
    }

    /**
     * Creates a form to delete a Workout entity.
     *
     * @param Workout $workout The Workout entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Workout $workout)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('workout_delete', array('id' => $workout->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
