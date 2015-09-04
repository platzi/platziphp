<?php
class UserTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    function it_should_be_able_to_construct()
    {
        $user = new \PlatziPHP\Domain\User('fake@email.dev', 'platzi');

        $this->assertInstanceOf(\PlatziPHP\Domain\User::class, $user);
    }

    /** @test */
    function it_should_have_a_first_name()
    {
        $user = new \PlatziPHP\Domain\User('email@example.com', '1234');

        $user->setName('Guido', 'Woda');

        $name = $user->getFirstName();

        $this->assertEquals('Guido', $name);
    }
}