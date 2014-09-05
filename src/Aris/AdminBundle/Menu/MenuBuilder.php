<?php

namespace Aris\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Aris\MainBundle\Entity\Category;

class MenuBuilder {
       private $factory;
        protected $doctrine;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory, $doctrine)
    {
        $this->factory = $factory;
         $this->doctrine = $doctrine;
    }

    public function createMainMenu(Request $request)
    {   
        
    // $this->get('doctrine')->getEntityManager();
       
        
        $menu = $this->factory->createItem('root');
        $menu->addChild('Portada', array('route' => 'portada'));
        $menu->addChild('Categorias', array('route' => 'category'));
       // $menu->addChild('Obras', array('route' => 'obra'));
       $menu->addChild('Histoy', array('route' => 'history'));
        $menu->addChild('Obras');
        
      //  $menu->addChild('Imágenes', array('route' => 'imagen'));
        $menu->addChild('Cerrar Sesión', array('route' => 'logout'));
        // ... add more children
        
        
        $em=$this->doctrine->getManager();
        $entities = $em->getRepository('ArisMainBundle:Category')->findAll();
        $menu['Obras']->addChild('Categorias:');
        foreach ($entities as $key=>$entity) {
          
             
             $menu['Obras']->addChild($entity->getNombre() , array('route' => 'obra', 'routeParameters' =>array('id'=>$entity->getId())));
        }
       
        
        return $menu;
    }
    
    
}
