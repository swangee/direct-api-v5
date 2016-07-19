<?php
namespace vedebel\directv5\Campaign\Properties;

use vedebel\directv5\Common\Object;

class CampaignType extends Object
{
    const MINIMAL_WEEKLY_BUDGET = 80;
    const MINIMAL_CLICK_PRICE = 0.08;

    /**
     * Campaign constructor.
     * @param array $attributes
     * @throws \Exception
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if ($this->getType() === 'CampaignType') {
            throw new \Exception('You should use instance of specific campaign');
        }
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return str_replace(__NAMESPACE__ . '\\', '', get_class($this));
    }

    /**
     * @param DirectStrategy $strategy
     */
    final public function setSearchBiddingStrategy(DirectStrategy $strategy)
    {
        $this->set('Search.BiddingStrategy', [
            'BiddingStrategyType' => $strategy->getType(),
            $strategy->getName() => $strategy
        ]);
    }

    /**
     * @param DirectStrategy $strategy
     */
    final public function setNetworkBiddingStrategy(DirectStrategy $strategy)
    {
        $this->set('Search.BiddingStrategy', [
            'BiddingStrategyType' => $strategy->getType(),
            $strategy->getName() => $strategy
        ]);
    }

    /**
     * @param array $counters
     */
    final public function setCounterIds(array $counters)
    {
        $this->set('CounterIds.Items', $counters);
    }
}