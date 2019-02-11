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


class Scenario5Cest
{
    /**
     * @param AcceptanceTester $I
     *
     * default language page and content are available
     * * first page is available in default language
     * * second page is available in default language
     *
     * home page has l18n_cfg=1 set
     *
     * expectation: 404 Page not found error
     */
    public function homePageIsNotRenderedInDefaultLanguage(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-5/en/');
        $I->seeInTitle('TYPO3 Exception');
        $I->see('(1/1) #1518472189 TYPO3\CMS\Core\Error\Http\PageNotFoundException');
        $I->see('Page is not available in default language.');
    }

    /**
     * @param AcceptanceTester $I
     *
     * first language has no language fallback defined in site configuration
     * page is translated into first language
     * first page in menu has l18n_cfg=1 set and is not translated into first language
     * second page in menu has l18n_cfg=1 set and is translated into first language
     *
     * expectation: page and content are displayed as is
     */
    public function homePageIsRenderedInFirstLanguageWherePageTranslationDoesExist(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-5/de/');
        $I->seeInTitle('Deutsch Scenario 5');
        $I->dontSee('first Page', 'li a[href]');
        $I->see('zweite Seite', 'li a[href]');
        $I->click('zweite Seite');
        $I->seeInTitle('zweite Seite');
        $I->dontSee('first Page', 'li a[href]');
        $I->see('zweite Seite', 'li a[href]');
    }

    /**
     * @param AcceptanceTester $I
     *
     * second language has fallback chain defined in site configuration as follows
     * * first step is first language
     * * second step is default language
     *
     * home page is available in default language
     * home page is translated into first language
     * home page is not translated into second language
     * home page has l18n_cfg=1 set
     * first page in menu has l18n_cfg=1 set and is not translated into second language
     * second page in menu has l18n_cfg = 0 set and is translated into second language
     *
     * expectation: page and content are displayed with first language
     */
    public function homePageIsRenderedInSecondLanguageWherePageTranslationDoesNotExist(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-5/de-ch/');
        $I->seeInTitle('Deutsch Scenario 5');
        $I->dontSee('first Page', 'li a[href]');
        $I->see('swiss second Seite', 'li a[href]');
    }

    /**
     * @param AcceptanceTester $I
     *
     * second language has fallback chain defined in site configuration as follows
     * * first step is first language
     * * second step is default language
     *
     * first page in menu has l18n_cfg=1 set and is not translated into second language
     * expectation: 404 Page not Found error
     */
    public function firstSubPageIsNotRenderedInSecondLanguageWherePageTranslationDoesNotExist(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-5/de-ch/first-page');
        $I->seeInTitle('TYPO3 Exception');
        $I->see('(1/1) #1518472189 TYPO3\CMS\Core\Error\Http\PageNotFoundException');
        $I->see('Page is not available in default language.');
    }

    /**
     * @param AcceptanceTester $I
     *
     * second language has fallback chain defined in site configuration as follows
     * * first step is first language
     * * second step is default language
     *
     * home page is translated into first language
     * home page is translated into second language
     * first page in menu has l18n_cfg=1 set and is not translated into second language
     * second page in menu has l18n_cfg = 0 set and is translated into second language
     * expectation: page in menu with l18n_cfg=1 set does not appear in menu but page is displayed in default language
     */
    public function secondSubPageIsRenderedInSecondLanguageWherePageTranslationExistsAndNotTranslatedPageIsNotInMenu(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-5/de-ch/swiss-second-seite');
        $I->seeInTitle('swiss second Seite');
        $I->dontSee('first Page', 'li a[href]');
        $I->see('swiss second Seite', 'li a[href]');
    }
}
