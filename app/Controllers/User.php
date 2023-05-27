<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Authentication\Passwords;

class User extends BaseController
{
    protected $helpers = ['setting', 'form'];

    public function __construct()
    {
        $this->data['title'] = 'User';
    }

    public function index()
    {
        $this->data['title'] = 'User Account';

        $this->data['user'] = auth()->user();

        return view('user/index', $this->data);
    }

    /**
     * Displays the form the login to the site.
     *
     * @return RedirectResponse|string
     */
    public function loginView()
    {
        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->loginRedirect());
        }

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        // If an action has been defined, start it up.
        if ($authenticator->hasAction()) {
            return redirect()->route('auth-action-show');
        }

        $this->data['title'] = 'Login';
        return view('user/login', $this->data);
    }

    /**
     * Attempts to log the user in.
     */
    public function loginAction(): RedirectResponse
    {
        $rules = $this->getValidationRules();
        if (!$this->validateData($this->request->getPost(), $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $credentials = $this->request->getPost(setting('Auth.validFields'));
        $credentials = array_filter($credentials);
        $credentials['password'] = $this->request->getPost('password');
        $remember = (bool) $this->request->getPost('remember');

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        // Attempt to login
        $result = $authenticator->remember($remember)->attempt($credentials);
        if (!$result->isOK()) {
            return redirect()->route('login')->withInput()->with('error', $result->reason());
        }

        // If an action has been defined for login, start it up.
        if ($authenticator->hasAction()) {
            return redirect()->route('auth-action-show')->withCookies();
        }

        return redirect()->to(config('Auth')->loginRedirect())->withCookies();
    }

    /**
     * Returns the rules that should be used for validation.
     *
     * @return array<string, array<string, array<string>|string>>
     * @phpstan-return array<string, array<string, string|list<string>>>
     */
    protected function getValidationRules(): array
    {
        $rules = [
            'password' => [
                'label' => 'Auth.password',
                'rules' => 'required|' . Passwords::getMaxLenghtRule(),
                'errors' => [
                    'max_byte' => 'Auth.errorPasswordTooLongBytes',
                ],
            ],
        ];

        if ($this->request->getPost('email') !== null) {
            $rules['email'] = [
                'label' => 'Auth.email',
                'rules' => config('AuthSession')->emailValidationRules,
            ];
        }

        if ($this->request->getPost('username') !== null) {
            $rules['username'] = [
                'label' => 'Auth.email',
                'rules' => config('AuthSession')->usernameValidationRules,
            ];
        }

        return $rules;
    }

    /**
     * Logs the current user out.
     */
    public function logoutAction(): RedirectResponse
    {
        $url = config('Auth')->logoutRedirect();

        auth()->logout();

        return redirect()->to($url)->with('message', lang('Auth.successLogout'));
    }
}
