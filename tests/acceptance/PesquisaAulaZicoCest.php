<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class PesquisaAulaZicoCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function PesquisaAulaZicoCest(AcceptanceTester $I)
    {
      $I->amOnPage('/projeto-integrador/ProgWeb/Desenvolvimento/home.html'); 
      $I->fillField('pesquisarCampo', 'aula do zico'); 
      $I->click('🔍'); 
      $I->see('Aula do Zico');
    }
}
