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


class Scenario2Cest
{
    /**
     * @param AcceptanceTester $I
     *
     * default language page and content are available
     * expectation: page and content are displayed as is
     */
    public function homePageIsRenderedInDefaultLanguage(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-2/en/');
        $I->seeInTitle('Scenario 2');
        $I->see('Page', 'li a');
        $I->click('Page');
        $I->seeInTitle('Page');
    }

    /**
     * @param AcceptanceTester $I
     *
     * first language has no language fallback defined in site configuration
     * page is not translated into first language (no container available)
     * expectation: 404 Page not found error
     */
    public function homePageIsNotRenderedInFirstLanguageWherePageTranslationDoesNotExist(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-2/de/');
        $I->seeInTitle('TYPO3 Exception');
        $I->see('(1/1) #1518472189 TYPO3\CMS\Core\Error\Http\PageNotFoundException');
    }

    /**
     * @param AcceptanceTester $I
     *
     * second language has fallback chain defined in site configuration as follows
     * * first step is first language
     * * second step is default language
     * page is not translated into second language
     * page is not translated into first language
     * page is available in default language
     * expectation: page and content from default language are displayed
     */
    public function homePageIsRenderedInSecondLanguageWherePageTranslationDoesNotExist(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-2/de-ch/');
        $I->seeInTitle('Scenario 2');
        $I->see('Page', 'li a');
        $I->click('Page');
        $I->seeInTitle('Page');
    }
}
