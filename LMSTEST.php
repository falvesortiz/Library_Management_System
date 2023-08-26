<?php

include 'LMS.php';

use PHPUnit\Framework\TestCase;
use SebastianBergmann\Type\VoidType;

final class LMSTEST extends TestCase
{
    public function testSearchBook(): void
    {
        $bookName = "Logics";

        $expectedBookId = "121212";
        $b = new Books();
        $books = $b->searchBook();

        $this->assertSame($expectedBookId, (string) $books["ISBN"]);


    }

    public function testSortAsc(): void
    {
        $b = new Books();
        $b = $b->sortBook();

        $books = [];
        $books[3] = "Eclipse";
        $books[1] = "Logics";

        $this->assertSame($books, $b);

    }

}

?>