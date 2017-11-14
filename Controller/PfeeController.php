<?php
namespace ZelmadBundle\Controller;
use ZelmadBundle\Entity\Pfee;
use ZelmadBundle\Event\MessagePostEvent;
use ZelmadBundle\Event\PlatformEvents;
use ZelmadBundle\Form\PfeeType;
use ZelmadBundle\Entity\Societe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PfeeController extends Controller
{
	public function indexAction($page)
	{
	   if ($page < 1) {
		  throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
		}
		// Ici je fixe le nombre d'annonces par page à 3
		// Mais bien sûr il faudrait utiliser un paramètre, et y accéder via $this->container->getParameter('nb_per_page')
		$nbPerPage = 5;
		// On récupère notre objet Paginator
		$listPfees = $this->getDoctrine()
		  ->getManager()
		  ->getRepository('ZelmadBundle:Pfee')
		  ->getPfees($page, $nbPerPage)
		;
		// On calcule le nombre total de pages grâce au count($listPfees) qui retourne le nombre total d'annonces
		$nbPages = ceil(count($listPfees) / $nbPerPage);
		// Si la page n'existe pas, on retourne une 404
		if ($page > $nbPages) {
		  throw $this->createNotFoundException("La page ".$page." n'existe pas.");
		}
		// On donne toutes les informations nécessaires à la vue
		return $this->render('ZelmadBundle:Pfee:index.html.twig', array(
		  'listPfees' => $listPfees,
		  'nbPages'     => $nbPages,
		  'page'        => $page,
		));
	}
		
	public function viewAction(Pfee $pfee)
	{
		$em = $this->getDoctrine()->getManager();
		
		return $this->render('ZelmadBundle:Pfee:view.html.twig', array(
		  'pfee' => $pfee,
		));
	}
		
	public function profileAction()
	{
		$em = $this->getDoctrine()->getManager();
		
		$user = $this->container->get('security.context')->getToken()->getUser();
		
		return $this->render('ZelmadBundle:Pfee:profile.html.twig', array(
			'user' => $user,
		));
	}
	
    public function choixAction(Request $request, Pfee $pfee)
	{
		$em = $this->getDoctrine()->getManager();
		
		$form = $this->get('form.factory')->create();
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
		{
		    $user = $this->container->get('security.context')->getToken()->getUser();
			if(!is_null($user->getPfee()))
			{
				$pfee1 = $user->getPfee();
				$nbreeleve1 = $pfee1->getNbreeleve();
				$pfee1->setNbreeleve($nbreeleve1+1);
			}
			$pfee1 = $user->getPfee();
			$user->setPfee($pfee);
			$nbreeleve = $pfee->getNbreeleve()-1;
			$pfee->setNbreeleve($nbreeleve);
			$em->persist($pfee);
			$em->persist($pfee);
			$em->persist($user);
		    $em->flush();
		    $request->getSession()->getFlashBag()->add('info', "Le PFE a bien été attribué.");
		    return $this->redirectToRoute('zelmad_home');
		}
		return $this->render('ZelmadBundle:Pfee:choix.html.twig', array(
		  'pfee' => $pfee,
		  'form'  => $form->createView(),
		));
	}
	
    public function deleteAction(Request $request, Pfee $pfee)
	{
		$em = $this->getDoctrine()->getManager();
		
		$form = $this->get('form.factory')->create();
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
		{
		    $em->remove($pfee);
		    $em->flush();
		    $request->getSession()->getFlashBag()->add('info', "L'annonce a bien été supprimée.");
		    return $this->redirectToRoute('zelmad_home');
		}
		return $this->render('ZelmadBundle:Pfee:delete.html.twig', array(
		  'pfee' => $pfee,
		  'form'  => $form->createView(),
		));
	}
	
	public function addAction(Request $request)
    {
		$pfee = new Pfee();
		$form   = $this->get('form.factory')->create(PfeeType::class, $pfee);
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($pfee);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'PFE bien enregistré.');
			return $this->redirectToRoute('zelmad_view', array('id' => $pfee->getId()));
		}
		return $this->render('ZelmadBundle:Pfee:add.html.twig', array(
		  'form' => $form->createView(),
		));
	}
}
