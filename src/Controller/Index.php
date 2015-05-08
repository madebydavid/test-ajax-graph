<?php

namespace Controller {
	
	use Silex\Application;
	use Silex\Api\ControllerProviderInterface;
	use Symfony\Component\HttpFoundation\Response;

	class Index implements ControllerProviderInterface {
		
		public function connect(Application $app) {
			$indexController = $app['controllers_factory'];
			$indexController->get("/", array( $this, 'index' ) );


			$indexController->get('/data', array($this, 'getData'));

			return $indexController;
		}

		public function index(Application $app) {
			  return $app['twig']->render('index.twig');
		}


		public function getData(Application $app) {

			$count = $app['request_stack']->getCurrentRequest()->get('count');
			$x = $app['request_stack']->getCurrentRequest()->get('x');

			$data = array();

			for ($i = 0; $i < $count; $i++) {
				$data[] = array(
					'x' => $x++,
					'y' => sin(deg2rad($x))
				);
				$x++;
			}

			return $app->json($data);

		}

		
	}
}
