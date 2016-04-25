<?php

class FunctionalTestCase extends TestCase
{
    use \Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

    protected $seed = true;

    public function setUp()
    {
        $this->afterApplicationCreated(function () {
            $this->artisan('migrate');
            if ($this->seed) {
                $this->artisan('db:seed', ['--class' => 'UserTableSeeder']);
            }
        });

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback');
        });

        parent::setUp();
    }
}
