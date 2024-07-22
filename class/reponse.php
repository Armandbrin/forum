<?php

class reponse{

    private $text;

    private $id_post;
    private $id_user;

    public function setText($text)
    {
        $this->text = $text;
    }
    public function getText()
    {
        return $this->text;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }
    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdPost($id_post)
    {
        $this->id_post = $id_post;
    }
    public function getIdPost()
    {
        return $this->id_post;
    }


}