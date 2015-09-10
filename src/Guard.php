<?php

namespace Sarav\Multiauth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Guard as OriginalGuard;

class Guard extends OriginalGuard {

    protected $name;
    
    /**
     * Create a new authentication guard.
     *
     * @param  \Illuminate\Contracts\Auth\UserProvider  $provider
     * @param  \Symfony\Component\HttpFoundation\Session\SessionInterface  $session
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     * @return void
     */
    public function __construct(UserProvider $provider, SessionStore $session, $name, Request $request = null) {

        parent::__construct($provider, $session, $request);

        $this->name = $name;
    }
    
    /**
     * Get a unique identifier for the auth session value.
     *
     * @return string
     */
    public function getName() {

        return 'login_' . $this->name . '_' . md5(get_class($this));

    }
    
    /**
     * Get the name of the cookie used to store the "recaller".
     *
     * @return string
     */
    public function getRecallerName() {

        return 'remember_' . $this->name . '_' . md5(get_class($this));

    }
}