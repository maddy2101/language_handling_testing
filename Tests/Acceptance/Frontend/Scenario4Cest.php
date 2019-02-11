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


class Scenario4Cest
{
    /**
     * @param AcceptanceTester $I
     *
     * default language page and content are available
     * first page is available in default language
     * second page is available in default language
     * expectation: page and content are displayed as is
     */
    public function homePageIsRenderedInDefaultLanguage(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-4/en/');
        $I->seeInTitle('Scenario 4');
        $I->see('first Page', 'li a[href]');
        $I->see('second Page', 'li a[href]');
        $I->click('first Page');
        $I->seeInTitle('first Page');
        $I->see('first Page', 'li a[href]');
        $I->see('second Page', 'li a[href]');
    }

    /**
     * @param AcceptanceTester $I
     *
     * first language has no language fallback defined in site configuration
     * page is not translated into first language (no container available)
     * page has l18n_cfg=2 set
     * expectation: 404 Page not found error
     */
    public function homePageIsNotRenderedInFirstLanguageWherePageTranslationDoesNotExist(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-4/de/');
        $I->seeInTitle('TYPO3 Exception');
        $I->see('(1/1) #1518472189 TYPO3\CMS\Core\Error\Http\PageNotFoundException');
    }

    /**
     * @param AcceptanceTester $I
     *
     * second language has fallback chain defined in site configuration as follows
     * * first step is first language
     * * second step is default language
     *
     * home page is available in default language
     * home page is not translated into first language
     * home page is not translated into second language
     * home page has l18n_cfg=2 set
     *
     * expectation: 404 Page not found error
     */
    public function homePageIsNotRenderedInSecondLanguageWherePageTranslationDoesNotExist(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-4/de-ch/');
        $I->seeInTitle('TYPO3 Exception');
        $I->see('(1/1) #1518472189 TYPO3\CMS\Core\Error\Http\PageNotFoundException');
        $I->see('Page is not available in the requested language.');
    }

    /**
     * @param AcceptanceTester $I
     *
     * second language has fallback chain defined in site configuration as follows
     * * first step is first language
     * * second step is default language
     * page is not translated into first language
     * page is not translated into second language
     * page in menu has l18n_cfg=2 set and is not translated into second language
     * expectation: page in menu with l18n_cfg=2 set does not appear in menu but page is displayed in default language
     */
    public function subPageIsRenderedInSecondLanguageWherePageTranslationDoesNotExistAndNotTranslatedPageIsNotInMenu(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-4/de-ch/second-page');
        $I->seeInTitle('second Page');
        $I->dontSee('first Page', 'li a[href]');
        $I->see('second Page', 'li a[href]');
    }
}
