<?php

class BlogPost
{
    public $id;
    public $title;
    public $post;
    public $author;
    public $tags;
    public $datePosted;

    function __construct($inId, $inTitle, $inPost, $inAuthorId, $inDatePosted)
    {

        $this->id = $inId;
        $this->title = $inTitle;
        $this->post = $inPost;


        $orderDate = explode("-", $inDatePosted);
        $this->datePosted = $orderDate[1] . "/" . $orderDate[2] . "/" . $orderDate[0];

    }
}