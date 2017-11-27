<?php

namespace AppBundle\Controller;

use AppBundle\Entity\WishList;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Wishlist controller.
 *
 * @Route("wishlist")
 */
class WishListController extends Controller
{
    /**
     * Lists all wishList entities.
     *
     * @Route("/", name="wishlist_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $wishLists = $em->getRepository('AppBundle:WishList')->findAll();

        return $this->render('wishlist/index.html.twig', array(
            'wishLists' => $wishLists,
        ));
    }

    /**
     * Creates a new wishList entity.
     *
     * @Route("/new", name="wishlist_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $wishList = new Wishlist();
        $form = $this->createForm('AppBundle\Form\WishListType', $wishList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wishList);
            $em->flush();

            return $this->redirectToRoute('wishlist_show', array('id' => $wishList->getId()));
        }

        return $this->render('wishlist/new.html.twig', array(
            'wishList' => $wishList,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a wishList entity.
     *
     * @Route("/{id}", name="wishlist_show")
     * @Method("GET")
     */
    public function showAction(WishList $wishList)
    {
        $deleteForm = $this->createDeleteForm($wishList);

        return $this->render('wishlist/show.html.twig', array(
            'wishList' => $wishList,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing wishList entity.
     *
     * @Route("/{id}/edit", name="wishlist_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, WishList $wishList)
    {
        $deleteForm = $this->createDeleteForm($wishList);
        $editForm = $this->createForm('AppBundle\Form\WishListType', $wishList);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('wishlist_edit', array('id' => $wishList->getId()));
        }

        return $this->render('wishlist/edit.html.twig', array(
            'wishList' => $wishList,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a wishList entity.
     *
     * @Route("/{id}", name="wishlist_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, WishList $wishList)
    {
        $form = $this->createDeleteForm($wishList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($wishList);
            $em->flush();
        }

        return $this->redirectToRoute('wishlist_index');
    }

    /**
     * Creates a form to delete a wishList entity.
     *
     * @param WishList $wishList The wishList entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(WishList $wishList)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('wishlist_delete', array('id' => $wishList->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
