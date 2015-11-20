<?php

namespace andres\videoclubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use andres\videoBundle\Entity\Peliculas;
use andres\videoBundle\Entity\PeliculasRepository;
use andres\videoBundle\Form\PeliculasType;


class PeliculasController extends Controller
{
  


    public  function verTodasAction()
    {
        $peliculas = new Peliculas();
       
        $pelis = $this->getDoctrine()->getRepository("videoBundle:Peliculas");
   

        return $this->render('videoBundle:Peliculas:verTodas.html.twig', array('pelis' => $pelis));

        
    }

   
     public  function peAddAction()
    {
        $peliculas = new Peliculas(); // instanciamos un usuario
        $form = $this->createCreateForm($peliculas); //ak creamos un objeto formulario con las caracteristicas UsER

        return $this->render('videoBundle:Peliculas:peAdd.html.twig', array('form' => $form->createView())); // ak renderizamos nuestro form 
    }


    private function createCreateForm(Peliculas $entity)
    {
        $form = $this->createForm (new PeliculasType(), $entity, array (
            'action' => $this->generateUrl('video_peCrear'),
            'method' => 'POST'  


            ));
        return $form;
    }



   public function peCrearAction(Request $request)
    {   
        $peliculas = new Peliculas();
        $form = $this->createCreateForm($peliculas);// aca le paso el usuario a la funcion de arriba para que cree el formulario
        $form->handleRequest($request); 
        
        if($form->isValid())
        {
          
            $em = $this->getDoctrine()->getManager();
            $em->persist($peliculas);
            $em->flush();
            $this->get('session')->getFlashBag()->add( //el flasag es para generar msj de error 
                'mensaje',
                'Pelìcula Registrada ');
            return $this->redirectToRoute('video_index');
        }
        
        return $this->render('videoBundle:Peliculas:peAdd.html.twig', array('form' => $form->createView()));
    }




}
	
