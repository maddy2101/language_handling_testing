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
     */
    public function homePageIsNotRenderedInFirstLanguageWherePageTranslationDoesNotExist(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-2/de/');
        $I->seeInTitle('Page Not Found (404)');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function homePageIsRenderedInSecondLanguageWherePageTranslationDoesNotExist(AcceptanceTester $I)
    {
        $I->amOnPage('/scenario-2/de-ch/');
        $I->seeInTitle('Scenario 2');
    }
}
