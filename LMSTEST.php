<?php

include 'LMS.php';

use PHPUnit\Framework\TestCase;

final class LMSTEST extends TestCase
{
    public function testSearchBook(): void
    {
        $bookName = "The big bang theory";

        $expectedBookId = "1234";
        $b = new Books();
        $books = $b->searchBook();

        $this->assertSame($expectedBookId, (string) $books["ISBN"]);

    }

    public function testSortAsc(): void
    {
        $b = new Books();
        $b = $b->sortBook();

        $books = [];
        $books[1] = "Barbi";
        $books[2] = "The big bang theory";
        $books[44] = "Zebra";

        $this->assertSame($books, $b);

    }

}

?>