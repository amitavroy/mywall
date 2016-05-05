<?php

class UserControllerTest extends FunctionalTestCase
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * UserControllerTest constructor.
     */
    public function __construct()
    {
        $this->faker = Faker\Factory::create();
    }

    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    /**
     * @param $username
     * @param $password
     * @param bool $remember
     * @return $this
     */
    private function loginUser($username, $password, $remember = false)
    {
        $this->visit('login')
            ->type($username, 'email')
            ->type($password, 'password');

        if ($remember) {
            $this->check('remember');
        }

        $this->press('Sign In');

        return $this;
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
            ->seePageIs('/')->see('Dashboard');
    }

    public function testLoginWithNewUser()
    {
        $email = $this->faker->email;

        $password = $this->faker->password;

        factory(\App\User::class)->create([
            'email' => $email,
            'password' => bcrypt($password),
            'status' => 1
        ]);

        $this->loginUser($email, $password);

        $this->seePageIs('/');
    }

    public function testLoginWithUnConfirmedUser()
    {
        $email = $this->faker->email;

        $password = $this->faker->password;

        factory(\App\User::class)->create([
            'email' => $email,
            'password' => bcrypt($password) . 121212,
            'status' => 0,
        ]);

        $this->visit('login')
            ->type($email, 'email')
            ->type($password, 'password')
            ->press('Sign In')
            ->seePageIs('login');


//        dump(\App\User::all()->toArray());
    }
}
