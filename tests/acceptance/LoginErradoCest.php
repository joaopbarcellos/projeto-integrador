<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class LoginErradoCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function loginErradoCest(AcceptanceTester $I)
    {
        $I->amOnPage('/projeto-integrador/ProgWeb/Desenvolvimento/index.html');
        $I->fillField('emailCampo', 'dwadawdawdada');
        $I->click('Entrar');
        $I->see('E-mail deve ser preenchido corretamente!');
    }
}
