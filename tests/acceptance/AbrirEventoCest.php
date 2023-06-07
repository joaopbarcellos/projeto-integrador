<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class AbreEventoCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function abrirEventoTest(AcceptanceTester $I)
    {
	    $I->amOnPage('/projeto-integrador/ProgWeb/Desenvolvimento/home.html'); 
	    $I->click('Saber Mais'); 
	    $I->seeCurrentURLEquals('/projeto-integrador/ProgWeb/Desenvolvimento/eventos/aulaZico.html');
    }
}
