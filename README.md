Kanji PHP
=========

A random PHP project.

Getting Started
---------------

Within the index.php, set the URIController's constructor argument to the path where you have Kanji PHP installed.
For example:

    /* if in root directory */
    $uri= new URIController();

    /* if in a directory "kanji" that sits inside root directory */
    $uri = new URIController("/kanji");

    /* if inside a directory "two", which is inside directory "one" in the root directory */
    $uri = new URIController("/one/two");

... you get the idea...


Creating your App
-----------------

Any class file in the /app directory should extend the Kanji class (see Home.php in the /app directory for reference).

    class MyPage extends Kanji {
  
      // called by referencign the class only (no public methods)
      // such as /myPage
      public function init ()
      {

        $this->setData("title", "My Page");
        $this->renderView();
      }

      // called via /myPage/show
      // or with argument, /myPage/show/5
      public function show($num = 1)
      {

        $this->setData("title", "Show $num times");
        $this->renderView();
      }
    }

The class is then called via a REST-like url that references the class.
For example, say your project is in a directory called "my_project", within your root directory.
Inside the app folder you create a class "MyPage" that extends the Kanji class.

You can then execute the class by using the url:

    http://[your_root]/my_project/myPage

Any public methods to your class can be accessed by appending the url with the method name.
Following the previous example, you can access a "show_all" method like so: 

    http://[your_root]/my_project/myPage/show

or to optionally pass an argument to the show method:

    http://[your_root]/my_project/myPage/show/5

This of course assumes the method called handles arguments

More Documentation
------------------

More documentation will be coming soon.