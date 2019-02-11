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


class Scenario1Cest
{
    /**
     * @param AcceptanceTester $I
     *
     * default language page and content are available
     * expectation: page and content are displayed as is
     */
    public function homePageIsRenderedInDefaultLanguage(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-1/en/');
        $I->seeInTitle('Scenario 1');
        $I->see('Page', 'li a[href]');
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
        $I->amOnPage('/scenario-1/de/');
        $I->seeInTitle('Deutsch Scenario 1');
        $I->see('Seite', 'li a[href]');
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
     * expectation: page is displayed in first language
     */
    public function homePageIsRenderedInSecondLanguageWherePageTranslationDoesNotExist(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-1/de-ch/');
        $I->seeInTitle('Deutsch Scenario 1');
    }
}
