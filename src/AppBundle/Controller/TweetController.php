<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Tweet;
use AppBundle\Form\Type\TweetType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class TweetController extends Controller
{

    /**
     * @Rest\View()
     * @Rest\Get("/events")
     */
    public function getTweetsAction(Request $request)
    {
        $page = $request->get('page', 1) ;
        $count = $request->get('count', 25);

        $criteria = [];
        if($request->get('username')) {
            $criteria['username'] = $request->get('username');
        }

        if($request->get('hashtag')) {
            $criteria['hashtag'] = $request->get('hashtag');
        }

        /* @var $tweets Tweet[] */
        $tweets = $this->get('doctrine.orm.entity_manager')
            ->getRepository(Tweet::class)
            ->findTweets($criteria, $page, $count);

        return $tweets;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/events/{id}")
     */
    public function getTweetAction($id, Request $request)
    {
        /* @var $tweet Tweet */
        $tweet = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Tweet')
            ->find($id);

        if (empty($tweet)) {
            return new JsonResponse(['message' => 'tweet not found'], Response::HTTP_NOT_FOUND);
        }

        return $tweet;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/events")
     */
    public function postTweetsAction(Request $request)
    {
        $tweet = new Tweet();
        $form = $this->createForm(TweetType::class, $tweet);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($tweet);
            $em->flush();
            return $tweet;
        } else {
            return $form;
        }
    }
}