<?php

// logic to interact with the user to find out the user requirement 
// antoher logic to call the respective function 


// do while start here
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
        //Calling function you need to create object first of the belogings class
        //addbook function is in class book 
        //So create obj of class book and with that object call function addBook
        $book = new Books();
        echo $book->addBook();
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
// do while finishes here




class libraryResource
{

    private $resource_category;
    private $iD;
}

class Books extends libraryResource
{
    private $bookName;
    private $bookISBN;
    private $bookPublisher;
    private $bookAuthor;

    //Create function 
    //Add Book 
    public function addBook()
    {
        $list = $this->returnValueFromJsonFile();


        $this->resource_category = "book";
        $this->iD = readline("Input the book`s ID: ");
        $this->bookName = readline("Input the book`s name: ");
        $this->bookISBN = readline("Input the book`s ISBN: ");
        $this->bookPublisher = readline("Input the book`s publisher: ");
        $this->bookAuthor = readline("Input the book`s author: ");

        //Create associative array 
        // Put this values on array
        global $book;
        $book = array(
            $this->iD => array(
                'Category' => $this->resource_category,
                'Name' => $this->bookName,
                'ISBN' => $this->bookISBN,
                'Publisher' => $this->bookPublisher,
                'Author' => $this->bookAuthor,
            )
        );

        array_push($list, $book);

        // return saying success
        return $this->saveArrayDataToJsonFile($list);

    }

    //Write in json file 
    public function saveArrayDataToJsonFile($book)
    {
        var_dump($book);
        $jasonData = json_encode($book);
        file_put_contents("jsonData.json", $jasonData);
        return "Data Saved";
    }

    public function returnValueFromJsonFile()
    {
        if (file_exists("jsonData.json")) {

            $jasonData = file_get_contents("jsonData.json");
            $dataArray = json_decode($jasonData, true);

            if (!empty($dataArray)) {
                return $dataArray;
            }
        }
        return array();
    }


    //Delete Book
    public function dellBook()
    {
        // PUXAR ARRAY DO JSONFILE
        // PERGUNTAR QUAL A CHAVE --ID-- QUE O USUARIO QUER APAGAR
        // USAR ARRA-PUSH (MAS PARA APAGAR)
        // SALVAR A LISTA NOVA NO ARRAY


    }

    //Add author
    public function addAuthor()
    {

    }

    //List Book 
    public function listBook()
    {

    }

    // Search book
    public function searchBook()
    {

    }

    //Sort book 
    public function sortBook()
    {

    }

    //Sort book descent
    public function sortBookDecs()
    {

    }
}

class otherResources extends libraryResource
{
    private $resName;
    private $resDescrip;
    private $resBrand;

    //Add resource
    public function addRes()
    {

    }

    //List resource
    public function listRes()
    {

    }

    //delete resource
    public function dellRes()
    {

    }
}

class Author
{

    private $autorId;
    private $authorName;
}




/* 
1 - user choose
2 - ask information of the new book 
3 - assign the values to the Object property
4 - save the new book (new object) in the json file
5 - 



crate a method for saving info to the json file
*/