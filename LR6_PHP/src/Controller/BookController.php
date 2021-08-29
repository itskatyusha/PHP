<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;  
use App\Entity\Books;

class BookController extends AbstractController
{
    #[Route('/new', name: 'book')]
    public function newAction(Request $request) { 
        $stud = new Books();
           $form = $this->createFormBuilder($stud) 
              ->add('name', TextType::class) 
              ->add('author', TextType::class) 
              ->add('date', TextType::class) 
              ->add('save', SubmitType::class, array('label' => 'Submit')) 
              ->getForm();  
    
       $form->handleRequest($request);  
   
        if ($form->isSubmitted() && $form->isValid()) { 
            $book = $form->getData(); 
            $doct = $this->getDoctrine()->getManager();  
            $doct->persist($book);   
            $doct->flush();  
            
            return $this->redirectToRoute('homepage'); 
        } else { 
            return $this->render('book/index.html.twig', array( 
                'form' => $form->createView(), 
            )); 
        }     
    } 


    #[Route('/update/{id}', name: 'book_upd')]
    public function updateAction($id, Request $request) { 
        $d = $this->getDoctrine()->getManager(); 
        $bk = $d->getRepository(Books::class)->find($id); 

        if (!$bk) { 
            throw $this->createNotFoundException( 
               'No book found for id '.$id 
            ); 
        }  

        //$stud = new Books();
           $form = $this->createFormBuilder($bk) 
              ->add('name', TextType::class) 
              ->add('author', TextType::class) 
              ->add('date', TextType::class) 
              ->add('save', SubmitType::class, array('label' => 'Submit')) 
              ->getForm();  
    
       $form->handleRequest($request);  
   
        if ($form->isSubmitted() && $form->isValid()) { 
            $book = $form->getData(); 
            $doct = $this->getDoctrine()->getManager();  
            
            // tells Doctrine you want to save the Product 
            $doct->persist($book);  
            
            //executes the queries (i.e. the INSERT query) 
            $doct->flush();  
            
            return $this->redirectToRoute('homepage'); 
        } else { 
            return $this->render('book/index.html.twig', array( 
                'form' => $form->createView(), 
            )); 
        }     
    }


    #[Route('/delete/{id}', name: 'book_del')]
    public function deleteAction($id, Request $request) { 
        $d = $this->getDoctrine()->getManager(); 
        $bk = $d->getRepository(Books::class)->find($id); 
   
        if (!$bk) { 
            throw $this->createNotFoundException('No book found for id '.$id); 
        } 
        $d->remove($bk); 
        $d->flush(); 
        return $this->redirectToRoute('homepage'); 
    }
     
}
