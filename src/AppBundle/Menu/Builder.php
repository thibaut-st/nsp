<?php
/**
 * Created by PhpStorm.
 * User: Thibaut
 * Date: 26/11/2017
 * Time: 19:44
 */

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        /*$menu = $factory->createItem('root');

        $menu->addChild('Home', array('route' => 'homepage'));

        // access services from the container!
        $em = $this->container->get('doctrine')->getManager();
        // findMostRecent and Blog are just imaginary examples
        $blog = $em->getRepository('AppBundle:Blog')->findMostRecent();

        $menu->addChild('Latest Blog Post', array(
            'route' => 'blog_show',
            'routeParameters' => array('id' => $blog->getId())
        ));

        // create another menu item
        $menu->addChild('About Me', array('route' => 'about'));
        // you can also add sub level's to your menu's as follows
        $menu['About Me']->addChild('Edit profile', array('route' => 'edit_profile'));

        // ... add more children

        return $menu;*/

        $checker = $this->container->get('security.authorization_checker');
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class','links-top list-inline');
        if ($checker->isGranted('ROLE_ADMIN')) {
//            $menu->addChild('admin panel', array('route' => 'admin'));
        }
        if ($checker->isGranted('ROLE_USER')) {
            $menu->addChild('account', array('route' => 'fos_user_security_login'));
            $menu->addChild('logout', array('route' => 'fos_user_security_logout'));
            $menu->addChild('user list', array('route' => 'user_index'));
        } else {
            $menu->addChild('registration', array('route' => 'fos_user_registration_register'));
            $menu->addChild('login', array('route' => 'fos_user_security_login'));
        }

        return $menu;
    }
}