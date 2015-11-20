<?php

namespace andres\videoclubBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request; // el objeto request que uso en el crearAccion 
use Symfony\Component\HttpFoundation\Response; // aca exporto esto para devolver un ob response de una 
use andres\videoclubBundle\Entity\Recargas;
use andres\videoclubBundle\Entity\Users;
use andres\videoclubBundle\Form\RecargasType;

class RecargasController extends Controller
{
    public function recargaAction()
    {
       
       
    	$recargas = new Recargas(); // instanciamos un usuario
        $form = $this->createCreateForm($recargas); //ak creamos un objeto formulario con las caracteristicas UsER

        return $this->render('videoBundle:Recargas:recarga.html.twig', array('form' => $form->createView())); // ak renderizamos 
    }



    private function createCreateForm(Recargas $entity)
    {
        $form = $this->createForm (new RecargasType(), $entity, array (
            'action' => $this->generateUrl('video_reCrear'),
            'method' => 'POST'  


            ));
        return $form;
    }



   public function reCrearAction(Request $request)
    {   
        $session=$request->getSession();
        $id = $session->get('id');

        #$repository = $this->getDoctrine()->getManager()->getRepository('UserBundle:User');
        #$users = $repository->find($id);
        
        $user= $this->getDoctrine()->getRepository('videoBundle:Users')->find($id);
        
        $recargas = new Recargas();
        $recargas->setUsers($user);
        $form = $this->createCreateForm($recargas);// aca le paso el usuario a la funcion de arriba para que cree el formulario
        $form->handleRequest($request); 
        
        if($form->isValid())
        {
          
            $em = $this->getDoctrine()->getManager();
            $em2 = $this->getDoctrine()->getManager();
            $monto= $recargas->getMonto(); 
            $saldo = $user->getSaldo();
            $nuevoSaldo= $monto + $saldo;
            $user->setSaldo($nuevoSaldo); 
            $em->persist($recargas);
            $em->flush();
            $em2->persist($user);
            $em2->flush();
            $session=$request->getSession();
            $session->set("saldo",$user->getSaldo()); 
            $this->get('session')->getFlashBag()->add( //el flasag es para generar msj de error 
                'mensaje',
                'Muchas Gracias por Realizar su recarga, Su Compra ya fué acreditada.');
            return $this->redirectToRoute('video_recarga');
        }
        
        return $this->render('videoBundle:Recargas:recarga.html.twig', array('form' => $form->createView() ));
    }





#   public function reCrearAction(Request $request)
 #   {   
  #      $session=$request->getSession();
   #     $id = $session->get('id');

        #$repository = $this->getDoctrine()->getManager()->getRepository('UserBundle:User');
        #$users = $repository->find($id);
        
    #    $user= $this->getDoctrine()->getRepository('videoBundle:Users')->find($id);
        
     #   $recargas = new Recargas();
      #  $recargas->setUsers($user);
       # $form = $this->createCreateForm($recargas);// aca le paso el usuario a la funcion de arriba para que cree el formulario
        #$form->handleRequest($request); 
        
     #   if($form->isValid())
      #  {
          
       #     $em = $this->getDoctrine()->getManager();
        #    $em->persist($recargas);
         #   $em->flush();
          #  $this->get('session')->getFlashBag()->add( //el flasag es para generar msj de error 
           #     'mensaje',
            #    'Muchas Gracias por Realizar su recarga, Su Compra ya fué acreditada.');
         #   return $this->redirectToRoute('video_recarga');
        #}
        
       # return $this->render('videoBundle:Recargas:recarga.html.twig', array('form' => $form->createView(), 'id'=>$id ));
    #  }


}