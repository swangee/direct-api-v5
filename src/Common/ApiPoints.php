<?php
namespace vedebel\directv5\Common;

use vedebel\directv5\Common\Exceptions\InvalidPointsException;

class ApiPoints
{
    /**
     * @var int
     */
    private $requestUsage;

    /**
     * @var int
     */
    private $availablePoints;

    /**
     * @var int
     */
    private $dailyLimit;

    /**
     * ApiPoints constructor.
     * @param string $pointsData
     * @throws InvalidPointsException
     */
    public function __construct(string $pointsData)
    {
        $points = explode('/', $pointsData);

        if (!isset($points[0])) {
            throw new InvalidPointsException(sprintf('Invalid points value. Expected x/x/x got: ', $pointsData));
        }

        if (!isset($points[1])) {
            throw new InvalidPointsException(sprintf('Invalid points value. Expected x/x/x got: ', $pointsData));
        }

        if (!isset($points[2])) {
            throw new InvalidPointsException(sprintf('Invalid points value. Expected x/x/x got: ', $pointsData));
        }
        
        $this->requestUsage = (int) $points[0];
        $this->availablePoints = (int) $points[1];
        $this->dailyLimit = (int) $points[2];
    }

    /**
     * @return int
     */
    public function getDailyLimit() : int
    {
        return $this->dailyLimit;
    }

    /**
     * @return int
     */
    public function getAvailablePoints() : int
    {
        return $this->availablePoints;
    }
}