<?php


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function showAction($slug)
    {
        // ...

        // /blog/my-blog-post
        $this->get('router')->generate('blog', array(
            'page' => 2,
            'category' => 'Symfony'
        ));
// /blog/2?category=Symfony
    }
}