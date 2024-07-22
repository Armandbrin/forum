<?php

class posts
{

    private $titrePosts;
    private $contenuePosts;
    private $id_user_posts;
    private $id_sous_categorie_posts;

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

    public function setIdUserPost($id_user_posts)
    {
        $this->id_user_posts = $id_user_posts;
    }
    public function getIdUserPost()
    {
        return $this->id_user_posts;
    }

    public function setIdSousCategoriePost($id_sous_categorie_posts)
    {
        $this->id_sous_categorie_posts = $id_sous_categorie_posts;
    }
    public function getIdSousCategoriePost()
    {
        return $this->id_sous_categorie_posts;
    }
    
}
