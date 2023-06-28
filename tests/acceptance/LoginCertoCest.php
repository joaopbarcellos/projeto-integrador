<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class LoginCertoCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function loginCertoCest(AcceptanceTester $I)
    {
        $I->amOnPage('/projeto-integrador/Desenvolvimento/index.html');
        $I->fillField('emailCampo', 'master@gmail.com');
        $I->fillField('senhaCampo', '123456');
        $I->click('Entrar');
        $I->seeCurrentURLEquals('/projeto-integrador/Desenvolvimento/home.html');
    }
}
