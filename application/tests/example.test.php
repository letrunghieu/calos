<?php

class TestExample extends PHPUnit_Framework_TestCase
{

    /**
     * Test that a given condition is met.
     *
     * @return void
     */
    public function testSomethingIsTrue()
    {
	$this->assertTrue(true);
    }

    public function testSendmail()
    {
	\Laravel\Bundle::start('phpmailer');
	\Laravel\Bundle::start('mailblade');
	$mailer = IoC::resolve('phpmailer');
	try
	{
	    $input = array(
		'display_name' => 'Example User',
		'email' => 'example@email.com',
		'url' => 'http://calos.local'
	    );

	    $message = Mailblade::make('password-restore', $input);
	    $mailer->AddAddress("letrunghieu.cse09@gmail.com", "Hieu Le");
	    $mailer->IsHTML(true);
	    $mailer->Subject = "Laravel Rocks";
	    $mailer->Body = $message->html();
	    $mailer->Send();
	} catch (Exception $e)
	{
	    echo 'Message was not sent.';
	    echo 'Mailer error: ' . $e->getMessage();
	}
    }

}