<?php
/**
 * User: orkin
 * Date: 16/02/2017
 * Time: 14:26
 */

namespace Album\Service;


use Album\Model\Album;

interface AlbumServiceInterface
{

    /**
     * @return Album[]
     */
    public function getAllAlbums();

    /**
     * @param int $id
     *
     * @return Album|null
     */
    public function getAlbumById(int $id);

    public function create(Album $album): Album;

    public function edit(Album $album): Album;

    public function delete(Album $album): bool;
}
