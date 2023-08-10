<?php

// logic to interact with the user to find out the user requirement 
// antoher logic to call the respective function 

echo "Welcome to Maddington Library" . PHP_EOL;
echo "Press 1 to add a book" . PHP_EOL;
echo "Press 2 to delete a book" . PHP_EOL;
echo "Press 3 to add an author" . PHP_EOL;
echo "Press 4 to list books" . PHP_EOL;
echo "Press 5 to search a book" . PHP_EOL;
echo "Press 6 to sort a book" . PHP_EOL;
echo "Press 7 to add a resource" . PHP_EOL;
echo "Press 8 to list resources" . PHP_EOL;
echo "Press 9 to delete resources" . PHP_EOL;

$userImput = readline("What do you want to do? Type here: ");

switch ($userImput) {
    case "1":
        addBook();
        break;
    case "2":
        dellBook();
        break;
    case "3":
        addAuthor();
        break;
    case "4":
        listBook();
        break;
    case "5":
        searchBook();
        break;
    case "6":
        sortBook();
        break;
    case "7":
        addRes();
        break;
    case "8":
        listRes();
        break;
    case "9":
        dellRes();
        break;
    default:
        echo "You didn't input a valid option!";
}

class libraryResource {

    private $resource_category;
    private $iD;
}

class Books extends libraryResource {
    private $bookName;
    private $bookISBN;
    private $bookPublisher;
    private $bookAuthor;

    //Create function 
    //Add Book 
    public function addBook(){

    }
    //Delete Book

    public function dellBook(){

    }

    //Add author

    public function addAuthor(){

    }

    //List Book 
    public function listBook(){

    }

    // Search book
    public function searchBook(){

    }

    //Sort book 
    public function sortBook(){

    }

    //Sort book descent
    public function sortBookDecs(){

    }
}

class otherResources extends libraryResource {
    private $resName;
    private $resDescrip;
    private $resBrand;

    //Add resource
    public function addRes(){

    }

    //List resource
    public function listRes(){

    }

    //delete resource
    public function dellRes(){

    }
}

class Author {

    private $autorId;
    private $authorName;
}