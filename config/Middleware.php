<?php
class Middleware {
    public $acceptedLanguages = ['en'];

    // We use '__invoke' function to run automatically when the object is defined
    public function __invoke() {
        $this->checkBrowserLanguage();
    }

    public function checkBrowserLanguage()
    {
        //We get the language used in the browser
        $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

        if (in_array($language, $this->acceptedLanguages, true) === false){
            echo "Your browser language (".$language.") is not supported by our program.";
            die();
        }
    }
}

