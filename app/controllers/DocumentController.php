<?php

class DocumentController extends BaseController {

    
    /**
    * The layout that should be used for responses.
    */
    protected $layout = 'layouts.master';
    
    
    public function viewDocument($document_key)
    {

        $document = Document::where('document_key', '=', $document_key)->firstOrFail();
        $this->layout->content = View::make('document',  array('document' => $document) );

    }

}