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
echo "Press 6 to ascending sort a book" . PHP_EOL;
echo "Press 7 to descending sort a book" . PHP_EOL;
echo "Press 8 to add a resource" . PHP_EOL;
echo "Press 9 to list resources" . PHP_EOL;
echo "Press 10 to delete resources" . PHP_EOL;

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
        searchBook();
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
        addRes();
        break;
    case "9":
        listRes();
        break;
    case "10":
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

    //Send values to an array (jsonfile)
    public function saveArrayDataToJsonFile($book)
    {
        $jasonData = json_encode($book);
        file_put_contents("jsonData.json", $jasonData);
        return "Data Saved";
    }

    //Function to get values from an array (jsonfile)
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
        //get values from the book list
        $list = $this->returnValueFromJsonFile();


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
            return $this->saveArrayDataToJsonFile($list);
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
        // access the $list 
        // $list = $this->returnValueFromJsonFile();

        //Get values form multidimentional arrays (WORKING BUT NOT FORMATTED)
        // print_r(array_values($list));


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