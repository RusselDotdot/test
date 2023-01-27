<?php

namespace App\Interfaces;

interface PostInterface {
    public function getAllPosts();

    public function getSpecificPost($post);

    public function addPost(array $data);
}