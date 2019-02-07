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
        $I->see('first Page', 'li a');
        $I->see('second Page', 'li a');
        $I->click('first Page');
        $I->seeInTitle('first Page');
    }

    /**
     * @param AcceptanceTester $I
     *
     * first language has no language fallback defined in site configuration
     * home page is translated into first language
     * expectation:
     * * home page is displayed in first language
     * * first page menu entry is displayed in first language
     * * second page menu entry is displayed in first language
     *
     */
    public function homePageIsRenderedInFirstLanguageWherePageTranslationExists(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-3/de/');
        $I->seeInTitle('Deutsch Scenario 3');
        $I->see('erste Seite', 'li a');
        $I->see('zweite Seite', 'li a');
        $I->click('erste Seite');
        $I->seeInTitle('erste Seite');
    }

    /**
     * @param AcceptanceTester $I
     *
     * second language has fallback chain defined in site configuration as follows
     * * only step is first language
     * home page is translated into first language
     * home page is translated into second language
     * first page in menu has l18n_cfg=2 set and is not translated into second language
     * second page in menu has l18n_cfg = 0 set and is translated into second language
     * expectation:
     * * home page is displayed in second language
     * * first page menu entry is not present
     * * second page menu entry is displayed in second language
     */
    public function homePageIsRenderedInSecondLanguageWherePageTranslationDoesNotExist(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-3/de-ch/');
        $I->seeInTitle('Swiss Scenario 3');
        $I->dontSee('first page', 'li a');
        $I->dontSee('erste Seite', 'li a');
        $I->see('swiss second Seite', 'li a');
    }
}
