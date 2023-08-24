<?php

include 'LMS.php';

use PHPUnit\Framework\TestCase;

final class LMSTEST extends TestCase
{
    public function testSearchBook(): void
    {
        $bookName = "Logics";

        $expectedBookId = "1";
        $b = new Books();
        $b->searchBook();

        $this->assertSame($expectedBookId,(string)$books["id"]);


    }
}

?>