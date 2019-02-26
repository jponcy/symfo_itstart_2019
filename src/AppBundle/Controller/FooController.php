<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class FooController
{

    /**
     * @Route("hello")
     */
    public function helloAction()
    {
        return new Response('<html><body><h1>Hello world</h1></body></html>');
    }

    /**
     * @Route("me")
     */
    public function meAction()
    {
        return new Response('<html><body><h1>Me</h1></body></html>');
    }
}
