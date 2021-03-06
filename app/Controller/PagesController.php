<?php

App::uses('AppController', 'Controller');

class PagesController extends AppController {
	public $name = 'Pages';

	public function beforeFilter() {
		parent::beforeFilter();

		$this->CapsuleAuth->allow( 'display' );
	}

	public function display() {
		$path = array_reverse( func_get_args() );

		$count = count( $path );
		if ( !$count ) 
			$this->redirect( '/' );
		
		$page = $subpage = $title_for_layout = null;

		if ( !empty( $path[ 0 ] ) ) {
			$page = $path[ 0 ];
		}
		if ( !empty( $path[ 1 ] ) ) {
			$subpage = $path[ 1 ];
		}
		if ( !empty( $path[ $count - 1 ] ) ) {
			switch ( $page . '.' . $subpage ) {
				case 'support.contact':
					$title_for_layout = 'Contact';
					break;
				case 'support.faq':
					$title_for_layout = 'F.A.Q.';
					break;
				case 'support.privacy':
					$title_for_layout = 'Confidentialité des données';
					break;
				case 'support.terms':
					$title_for_layout = 'Conditions d\'utilisation';
					break;
				case 'support.login-help':
					$title_for_layout = 'Résolution des problèmes de connexion';

					// Test for UL servers availability
					$this->set( 'serversAvailability', $this->CapsuleAuth->pokeULServers() );
					break;
			}
		}

		$this->set( compact( 'page', 'subpage', 'title_for_layout' ) );
		$this->set( 'sidebar', 'support' );
		$this->render( implode('/', $path));
	}
}
