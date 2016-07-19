<?php
namespace vedebel\directv5\Campaign\Properties\FundsParam;

use vedebel\directv5\Common\Object;

/**
 * Class CampaignFundsParam
 * @package vedebel\directv5\Campaign\Properties
 *
 * @property int $sum
 * @property int $balance
 * @property int $balanceBonus
 * @property int|null $sumAvailableForTransfer
 */
class CampaignFundsParam extends Object
{
    /**
     * FundsParam constructor.
     *
     * @param int $sum
     * @param int $balance
     * @param int $balanceBonus
     * @param int $sumAvailableForTransfer
     */
    public function __construct(int $sum, int $balance = null, int $balanceBonus = null, int $sumAvailableForTransfer = null)
    {
        $attributes = [
            'sum' => $sum,
            'balance' => $balance,
            'balanceBonus' => $balanceBonus
        ];

        if (!is_null($sumAvailableForTransfer)) {
            $attributes['sumAvailableForTransfer'] = $sumAvailableForTransfer;
        }

        parent::__construct($attributes);
    }
}