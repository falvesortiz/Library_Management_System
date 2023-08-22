<?php

echo "Welcome to Maddington Library" . PHP_EOL;
echo PHP_EOL;

// do while start here
do {    
    echo "Press 1 to add a book" . PHP_EOL;
    echo "Press 2 to delete a book" . PHP_EOL;
    echo "Press 3 to add an author" . PHP_EOL;
    echo "Press 4 to list books" . PHP_EOL;
    echo "Press 5 to search a book" . PHP_EOL;
    echo "Press 6 to sort books ascending" . PHP_EOL;
    echo "Press 7 to sort books descending" . PHP_EOL;
    echo "Press 8 to add a resource" . PHP_EOL;
    echo "Press 9 to list resources" . PHP_EOL;
    echo "Press 10 to delete resources" . PHP_EOL;

    $userImput = readline("What do you want to do? Type here: ");

    switch ($userImput) {
        case "1":
            $book = new Books();
            echo $book->addBook();
            break;
        case "2":
            $book = new Books();
            echo $book->dellBook();
            break;
        case "3":
            addAuthor();
            break;
        case "4":
            $book = new Books();
            echo $book->listBook();
            break;
        case "5":
            $book = new Books();
            echo $book->searchBook();
            break;
        case "6":
            $book = new Books();
            echo $book->sortBook();
            break;
        case "7":
            $book = new Books();
            echo $book->sortBookDesc();
            break;
        case "8":
            $resource = new otherResources();
            echo $resource->addRes();
            break;
        case "9":
            $resource = new otherResources();
            echo $resource->listRes();
            break;
        case "10":
            $resource = new otherResources();
            echo $resource->dellRes();
            break;
        default:
            echo "You didn't input a valid option!";
    }

    $i = readline("Do you want to continue (yes/no): ");

// do while finishes here
} while ($i == "yes");

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
        $list = returnValueFromJsonFile();

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
        return saveArrayDataToJsonFile($list);

    }



    //Delete Book
    public function dellBook()
    {
        //get values from the book list
        $list = returnValueFromJsonFile();


        // PERGUNTAR QUAL A CHAVE --ID-- QUE O USUARIO QUER APAGAR
        $this->iD = readline("Input the book`s ID you want to delete: ");

        $index = null;

        foreach ($list as $key => $book) {
            foreach ($book as $i => $v) {
                if ($i == $this->iD) {
                    $index = $key;
                }
            }
        }

        if ($index != null) {
            // USAR ARRAy_PUSH (MAS PARA APAGAR)
            unset($list[$index]);

            // SALVAR A LISTA NOVA NO ARRAY
            return saveArrayDataToJsonFile($list);
        }

        echo "The ID you submited is not valid. Try again.";
    }

    //Add author
    public function addAuthor()
    {

    }

    //List Book 
    public function listBook()
    {

        // USING FOREACH LOOP (WORKING BEAUTIFULLY)
        $json = file_get_contents("jsonData.json");
        $book = json_decode($json, true);

        $key = null;
        foreach ($book as $key => $value) {
            foreach ($value as $keys => $books) {
                if ($books["Category"] == "book") {
                    echo "Book ID: " . $keys . " - Book Name: " . $books["Name"] . PHP_EOL;
                }
            }
        }
    }

    // Search book
    public function searchBook()
    {
        $userImput = readline("What book do you want to search?: ");

        // Access the json file and return the array
        $json = file_get_contents("jsonData.json");
        $book = json_decode($json, true);

        foreach ($book as $key => $value) {
            foreach ($value as $keys => $books) {
                if ($userImput == $books["Name"]) {
                    print_r($books);
                }
            }
        }
    }

    //Sort book 
    public function sortBook()
    {

        // get data from json file
        $json = file_get_contents("jsonData.json");
        $book = json_decode($json, true);

        //loop the array inside array.
        //Check if the resource category is Book
        //Get the book's ID [keys] and the book's name
        foreach ($book as $key => $value) {
            foreach ($value as $keys => $books) {
                if ($books["Category"] == "book") {
                    $b[$keys] = $books["Name"];
                }
            }
        }

        //Sort the list by the books name and print the array 
        asort($b);
        print_r($b);

    }


    //Sort book descent
    public function sortBookDesc()
    {

        // get data from json file
        $json = file_get_contents("jsonData.json");
        $book = json_decode($json, true);

        //Loop the array inside array.
        //Check if the resource category is Book
        //Get the book's ID [keys] and the book's name
        foreach ($book as $key => $value) {
            foreach ($value as $keys => $books) {
                if ($books["Category"] == "book") {
                    $b[$keys] = $books["Name"];
                }
            }
        }

        //Descending sort the list by the books name and print the array 
        arsort($b);
        print_r($b);

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
        $list = returnValueFromJsonFile();

        $this->resource_category = "Other Resource";
        $this->iD = readline("Input the resource`s ID: ");
        $this->resName = readline("Input the resource`s name: ");
        $this->resDescrip = readline("Input the resource`s description: ");
        $this->resBrand = readline("Input the resource`s brand: ");

        //Create associative array 
        // Put this values on array
        global $book;
        $book = array(
            $this->iD => array(
                'Category' => $this->resource_category,
                'Name' => $this->resName,
                'Description' => $this->resDescrip,
                'Brand' => $this->resBrand,
            )
        );

        array_push($list, $book);

        // return saying success
        return saveArrayDataToJsonFile($list);

    }

    //List resource
    public function listRes()
    {

        // USING FOREACH LOOP (WORKING BEAUTIFULLY)
        $json = file_get_contents("jsonData.json");
        $book = json_decode($json, true);

        foreach ($book as $key => $value) {
            foreach ($value as $keys => $books) {
                if ($books["Category"] == "Other Resource") {
                    echo "Resource ID: " . $keys . " - Resource Name: " . $books["Name"] . PHP_EOL;
                }
            }
        }

    }

    //delete resource
    public function dellRes()
    {

        //get values from the book list
        $list = returnValueFromJsonFile();


        // PERGUNTAR QUAL A CHAVE --ID-- QUE O USUARIO QUER APAGAR
        $this->iD = readline("Input the resources`s ID you want to delete: ");

        $index = null;

        foreach ($list as $key => $book) {
            foreach ($book as $i => $v) {
                if ($i == $this->iD) {
                    $index = $key;
                }
            }
        }

        if ($index != null) {
            // unset para remover data da array
            unset($list[$index]);

            // SALVAR A LISTA NOVA NO ARRAY
            return saveArrayDataToJsonFile($list);
        }

        echo "The ID you submited is not valid. Try again.";


    }
}

class Author
{

    private $autorId;
    private $authorName;
}

//Send values to an array (jsonfile)
function saveArrayDataToJsonFile($book)
{
    $jasonData = json_encode($book);
    file_put_contents("jsonData.json", $jasonData);
    return "Data Saved";
}

//Function to get values from an array (jsonfile)
function returnValueFromJsonFile()
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