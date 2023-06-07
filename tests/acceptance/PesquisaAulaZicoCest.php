<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class PesquisaAulaZico
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function PesquisaAulaZico(AcceptanceTester $I)
    {
      $I->amOnPage('/projeto-integrador/ProgWeb/Desenvolvimento/home.html'); 
      $I->fillField('null', 'Aula do Zico'); 
      $I->click('🔍'); 
      $I->click('Saber Mais'); 
      $I->seeCurrentURLEquals('/projeto-integrador/ProgWeb/Desenvolvimento/eventos/aulaZico.html');
    }
}
