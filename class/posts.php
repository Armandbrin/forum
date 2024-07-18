<?php

class posts
{

    private $titrePosts;
    private $contenuePosts;

    public function setPostTitre($titrePosts)
    {
        $this->titrePosts = $titrePosts;
    }

    public function getPostTitre()
    {
        return $this->titrePosts;
    }

    public function setPostContenue($contenuePosts)
    {
        $this->contenuePosts = $contenuePosts;
    }

    public function getPostContenue()
    {
        return $this->contenuePosts;
    }
    
}
