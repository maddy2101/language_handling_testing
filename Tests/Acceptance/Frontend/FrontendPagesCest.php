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

/**
 * Tests clicking through some frontend pages
 */
class FrontendPagesCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function firstPageIsRendered(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('[1] DE_CH > DE_DE > EN');
        $I->click('Sub 1');
        $I->see('[2] Sub 1');
    }
}
