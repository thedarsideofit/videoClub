<?php

namespace andres\videoclubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request; // el objeto request que uso en el crearAccion 
use Symfony\Component\HttpFoundation\Response; // aca exporto esto para devolver un ob response de una 
use andres\videoclubBundle\Entity\Users;
use andres\videoclubBundle\Form\UsersType;
use andres\videoclubBundle\Entity\PeliculasRepository;
use andres\videoclubBundle\Entity\Peliculas;


class UserController extends Controller
{
   


    public function indexAction(Request $request)
    {
    	$session=$request->getSession();
    	if($session->has("id")) {   //has uso para recuperar los datos de las sessiones ya creadas . 
       
        return $this->render('videoBundle:User:index.html.twig');

          
        	
      
    	
    	}else{	

    		$this->get('session')->getFlashBag()->add( //el flasag es para generar msj de error 
    			'mensaje',
    			'Debe estar logueado para ver este contenido');
    			return $this->redirect($this->generateUrl('video_login'));	

    	}
    }





    //loguin 
    public function loginAction(Request $request) //RECIBBE UNA VARIABLE DE TIPO REQUEST 
    {
        
    	
        if($request->getmethod()=="POST") {// ACA LE PREGUNTAMOS SI NOS TRAE POR EL METODO POST.
    		//primero declaro las dos variable y le pido al ob request que trae los datos que me los de
    		$usuario= $request->get("usuario");
    		$contraseña= $request->get("contraseña");
    		$user= $this->getDoctrine()->getRepository('videoBundle:Users')->findOneBy(array("username"=>$usuario, "password"=>$contraseña));

    		if($user)
    		{
    			$session=$request->getSession(); // ak usamos el objeto session de la variable requst para mantener sesiones
    			$session->set("id",$user->getId());
    			$session->set("username",$user->getUsername());
                $session->set("saldo",$user->getSaldo()); 
             
				echo $session->get("username");
				return $this->redirect($this->generateUrl('video_index'));	

    		}else{

    			$this->get('session')->getFlashBag()->add( //el flasag es para generar msj de error 
    			'mensaje',
    			'El nombre de usuario o la contraseña no son válidos');
    			return $this->redirect($this->generateUrl('video_login'));	
    		}
    	}

        return $this->render('videoBundle:User:login.html.twig');
    }



     public function logoutAction(Request $request)
    {
    	$session=$request->getSession();
    	$session->clear();

    			$this->get('session')->getFlashBag()->add( //el flasag es para generar msj de error 
    			'mensaje',
    			'Su Sesión se cerro exitosamente');
    			return $this->redirect($this->generateUrl('video_login'));	
    }




     public  function usAddAction()
    {
        $user = new Users(); // instanciamos un usuario
        $form = $this->createCreateForm($user); //ak creamos un objeto formulario con las caracteristicas UsER

        return $this->render('videoBundle:User:usAdd.html.twig', array('form' => $form->createView())); // ak renderizamos nuestro form 
    }



    private function createCreateForm(Users $entity)
    {
        $form = $this->createForm (new UsersType(), $entity, array (
            'action' => $this->generateUrl('video_usCrear'),
            'method' => 'POST'  


            ));
        return $form;
    }



   public function usCrearAction(Request $request)
    {   
        $user = new Users();
        $form = $this->createCreateForm($user);// aca le paso el usuario a la funcion de arriba para que cree el formulario
        $form->handleRequest($request); 
        $session=$request->getSession(); // ak usamos el objeto session de la variable requst para mantener sesiones
        // VERIFICAR .. .$ids = $session->get("id");
        if($form->isValid())
        {
          
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->get('session')->getFlashBag()->add( //el flasag es para generar msj de error 
                'mensaje',
                'Muchas Gracias Por Registrase, Ya puede iniciar su Sesión ');
            return $this->redirectToRoute('video_login');
        }
        
        return $this->render('videoBundle:User:usAdd.html.twig', array('form' => $form->createView()));
    }



}
