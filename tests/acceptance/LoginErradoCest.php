<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class LoginErradoCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function loginErrado(AcceptanceTester $I)
    {
      $I->amOnPage('/projeto-integrador/ProgWeb/Desenvolvimento/index.html');
      $I->fillField('null', 'dadwadwadadwadwa');
      $I->click('Entrar');
      $I->see('E-mail está fora dos padrões!');
    }
}
