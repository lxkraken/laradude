<?php

class RemindersController extends BaseController {
	
	protected $layout = 'layouts.main';

  /**
   * Display the password reminder view.
   *
   * @return Response
   */
  public function getRemind()
  {
		$this->layout->content = View::make('password.remind');

  }

  /**
   * Handle a POST request to remind a user of their password.
   *
   * @return Response
   */
  public function postRemind()
  {
	$response = Password::remind(Input::only('email'), function($message){
				$message->subject('Distribution Dude - Réinitialisation de votre mot de passe'); 
			});
			
	switch($response)
	{
		
		case Password::INVALID_USER:
          return Redirect::back()->with('error', Lang::get('user'));
		
		case Password::REMINDER_SENT:
          return Redirect::back()->with('status', Lang::get('sent'));
	
	}
    
  }

  /**
   * Display the password reset view for the given token.
   *
   * @param  string  $token
   * @return Response
   */
  public function getReset($token = null)
  {
    if (is_null($token)) App::abort(404);

    $this->layout->content = View::make('password.reset')->with('token', $token);
  }

  /**
   * Handle a POST request to reset a user's password.
   *
   * @return Response
   */
  public function postReset()
  {
    $credentials = Input::only(
      'email', 'password', 'password_confirmation', 'token'
    );

    $response = Password::reset($credentials, function($user, $password)
    {
      $user->password = Hash::make($password);

      $user->save();
    });

    switch ($response)
    {
      case Password::INVALID_PASSWORD:
      case Password::INVALID_TOKEN:
      case Password::INVALID_USER:
        return Redirect::back()->with('error', Lang::get($response));

      case Password::PASSWORD_RESET:
        return Redirect::to('/');
    }
  }
}


