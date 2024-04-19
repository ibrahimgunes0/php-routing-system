<?php
class Middleware {
    // Array to store accepted languages
    public $acceptedLanguages = ['en'];

    /**
     * __invoke
     *
     * This magic method is used to automatically run when the object is defined.
     * It checks the browser language and invokes the checkBrowserLanguage method.
     */
    public function __invoke() {
        // Check if HTTP_ACCEPT_LANGUAGE header is set
        if ($_SERVER['HTTP_ACCEPT_LANGUAGE']){
            $this->checkBrowserLanguage();
        }
    }

    /**
     * checkBrowserLanguage
     *
     * Checks the language used in the browser against the accepted languages.
     * If the browser language is not supported, it outputs an error message and terminates the script.
     */
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

