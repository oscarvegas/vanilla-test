<?php

App::uses('HttpSocket', 'Network/Http');

class GithubController extends AppController
{
	public function beforeFilter()
	{
		parent::beforeFilter();

		//CONFIG TO SET :: 
		$this->clientID     = 'e2a83c5a---';
		$this->clientSecret = 'fb5ed08f---';

		$this->githubURL    = 'https://api.github.com';
		$this->githubAuth   = 'https://github.com/login/oauth/authorize';

		$this->userParams = [
			'client_id'    => $this->clientID,
			'login'        => 'oscarvegas',
			'redirect_uri' => 'http://localhost/vanilla/github/authredir',
			'scope'        => 'user repo',
		];

	}


	public function start()
	{

		$hasToken = $this->Session->read('Github.access_token');
		
		$this->set(compact('hasToken'));
	}

	public function authgithub()
	{
		$HttpSocket = new HttpSocket();
		$response = $HttpSocket->get($this->githubAuth, $this->userParams);
	
		$this->redirect($response->getHeader('Location'));
	}

	public function authredir()
	{
		$this->userParams['client_secret'] = $this->clientSecret;
		$this->userParams['code']          = $this->params->query['code'];

		unset($this->userParams['scope']);

		//POST https://github.com/login/oauth/access_token
		$HttpSocket = new HttpSocket();
		$response = $HttpSocket->post('https://github.com/login/oauth/access_token', $this->userParams);
	
		// USER :: https://api.github.com/user
		$stringParams = explode('&', $response->body);
		$accessToken  = explode('=', $stringParams[0]);
		
		$this->Session->write('Github.access_token', $accessToken[1]);
		
		$this->redirect(['action'=>'start']);

	}

	public function checkrepos()
	{
		$accessToken = $this->Session->read('Github.access_token');

		$HttpSocket = new HttpSocket([
			'header' => [
					'Authorization' => 'token '. $accessToken
				]
		]);

		$response = $HttpSocket->get('https://api.github.com/oscarvegas');

		pr($response);
		die();


	}

	public function resetkeys()
	{
		$this->Session->delete('Github.access_token');

		$this->redirect(['action'=>'start']);
	}
}
