<?php
declare(strict_types = 1);
namespace T3G\LanguageHandlingTesting\Tests\Acceptance\Frontend;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use T3G\LanguageHandlingTesting\Tests\Acceptance\Support\AcceptanceTester;


class Scenario3Cest
{
    /**
     * @param AcceptanceTester $I
     *
     * default language page and content are available
     * expectation: page and content are displayed as is
     */
    public function homePageIsRenderedInDefaultLanguage(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-3/en/');
        $I->seeInTitle('Scenario 3');
        $I->see('Page', 'li a');
        $I->click('Page');
        $I->seeInTitle('Page');
    }

    /**
     * @param AcceptanceTester $I
     *
     * first language has no language fallback defined in site configuration
     * page is translated into first language
     * expectation: page is displayed in first language
     *
     */
    public function homePageIsRenderedInFirstLanguageWherePageTranslationExists(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-3/de/');
        $I->seeInTitle('Deutsch Scenario 3');
        $I->see('Seite', 'li a');
        $I->click('Seite');
        $I->seeInTitle('Seite');
    }

    /**
     * @param AcceptanceTester $I
     *
     * second language has fallback chain defined in site configuration as follows
     * * only step is first language
     * page is translated into first language
     * page is not translated into second language
     * page has l18n_cfg=2 set
     * expectation: request returns a 404 status cpde
     */
    public function homePageIsRenderedInSecondLanguageWherePageTranslationDoesNotExist(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-3/de-ch/');
        $I->seeInTitle('TYPO3 Exception');
        $I->see('(1/1) #1518472189 TYPO3\CMS\Core\Error\Http\PageNotFoundException');
    }

    /**
     * @param AcceptanceTester $I
     *
     * second language has fallback chain defined in site configuration as follows
     * * only step is first language
     * page is translated into first language
     * page is translated into second language
     * page in menu has l18n_cfg=2 set and is not translated into second language
     * expectation: page in menu with l18n_cfg=2 set does not appear in menu
     */
    public function subPageIsRenderedInSecondLanguageWherePageTranslationExistAndNotTranslatedPageIsNotInMenu(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-3/de-ch/seite-2');
        $I->seeInTitle('Seite 2');
        $I->dontSee('Page', 'li a');
        $I->see('Seite 2', 'li a');
        $I->see('[Translate to Swiss German:] [16] Header', 'h2');
    }
}
