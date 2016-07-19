<?php
/**
 * Created by PhpStorm.
 * User: hollowj
 * Date: 23.05.16
 * Time: 17:02
 */

namespace vedebel\directv5\Common;


class Pagination implements \JsonSerializable
{
    const MAX_LIMIT = 10000;

    /**
     * @var
     */
    private $limit;

    /**
     * @var
     */
    private $offset;

    /**
     * @var bool $hasNext
     */
    private $hasNext;

    /**
     * Pagination constructor.
     * @param int $limit
     * @param int $offset
     */
    public function __construct(int $offset = 0, int $limit = self::MAX_LIMIT)
    {
        $this->setLimit($limit);
        $this->setOffset($offset);

        $this->hasNext = false;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit > self::MAX_LIMIT ? self::MAX_LIMIT : $limit;

        return $this;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function setOffset(int $offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @return $this
     */
    public function next()
    {
        $this->setOffset($this->offset + $this->limit);

        return $this;
    }

    /**
     * @return $this
     */
    public function prev()
    {
        $offset = $this->offset - $this->limit;

        if ($offset < 0) {
            $offset = 0;
        }

        $this->setOffset($offset);

        return $this;
    }

    /**
     * @param int $page
     * @return $this
     */
    public function setPage(int $page)
    {
        $this->setOffset(($page - 1) * $this->limit);

        return $this;
    }

    /**
     * @return bool
     */
    public function hasNext() : bool
    {
        return $this->hasNext;
    }

    /**
     * @param bool $hasNext
     */
    public function setHasNext(bool $hasNext)
    {
        $this->hasNext = $hasNext;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return ['Limit' => $this->limit, 'Offset' => $this->offset];
    }
}