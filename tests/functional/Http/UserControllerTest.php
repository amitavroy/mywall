<?php

class UserControllerTest extends FunctionalTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    public function testUserLoginPage()
    {
        $this->visit('login')
            ->see('Sign in to start your session');
    }

    public function testUserLoginForm()
    {
        $this->visit('login')
            ->type('reachme@amitavroy.com', 'email')
            ->type('password', 'password')
            ->press('Sign In')
            ->seePageIs('/');
    }
}
