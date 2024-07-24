<?php

class report
{

    private $id_user;
    private $id_post;
    private $id_reponse;
    private $id_message;


    public function getId_user()
    {
        return $this->id_user;
    }
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getId_post()
    {
        return $this->id_post;
    }
    public function setId_post($id_post)
    {
        $this->id_post = $id_post;

        return $this;
    }

    public function getId_reponse()
    {
        return $this->id_reponse;
    }
    public function setId_reponse($id_reponse)
    {
        $this->id_reponse = $id_reponse;

        return $this;
    }

    public function getId_message()
    {
        return $this->id_message;
    }
    public function setId_message($id_message)
    {
        $this->id_message = $id_message;

        return $this;
    }
}
