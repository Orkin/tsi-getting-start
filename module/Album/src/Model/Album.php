<?php
/**
 * User: orkin
 * Date: 13/02/2017
 * Time: 17:07
 */
declare(strict_types = 1);


namespace Album\Model;


class Album
{

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $artist;

    /**
     * @var string
     */
    public $title;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id     = $data['id'] ?? null;
        $this->artist = $data['artist'] ?? null;
        $this->title  = $data['title'] ?? null;
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return [
            'id'     => $this->id,
            'artist' => $this->artist,
            'title'  => $this->title,
        ];
    }
}
