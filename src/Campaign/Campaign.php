<?php
namespace vedebel\directv5\Campaign;

use vedebel\directv5\Campaign\Properties\BlockedIps;
use vedebel\directv5\Campaign\Properties\CampaignAssistant;
use vedebel\directv5\Campaign\Properties\DailyBudget;
use vedebel\directv5\Campaign\Properties\DynamicTextCampaign;
use vedebel\directv5\Campaign\Properties\ExcludedSites;
use vedebel\directv5\Campaign\Properties\FundsParam;
use vedebel\directv5\Campaign\Properties\MobileAppCampaign;
use vedebel\directv5\Campaign\Properties\NegativeKeywords;
use vedebel\directv5\Campaign\Properties\Notification;
use vedebel\directv5\Campaign\Properties\TextCampaign;
use vedebel\directv5\Campaign\Properties\TimeTargeting;
use vedebel\directv5\Common\Object;
use vedebel\directv5\Common\Statistics;

/**
 * Class CampaignAddItem
 * @package vedebel\directv5\Campaign
 *
 * @property int $id
 * @property string $name
 * @property string $startDate
 * @property string $endDate
 * @property DailyBudget $dailyBudget
 * @property NegativeKeywords $negativeKeywords
 * @property BlockedIps $blockedIps
 * @property ExcludedSites $excludedSites
 * @property string $clientInfo
 * @property Notification $notification
 * @property TimeTargeting $timeTargeting
 * @property string $timeZone
 * @property TextCampaign $textCampaign
 * @property DynamicTextCampaign $dynamicTextCampaign
 * @property MobileAppCampaign $mobileAppCampaign
 * @property Statistics $statistics
 * @property string $type
 * @property string $status
 * @property string $state
 * @property string $statusPayment
 * @property string $statusClarification
 * @property string $currency
 * @property FundsParam $funds
 * @property CampaignAssistant $representedBy
 */
class Campaign extends Object
{
    /**
     * Campaign constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $startDate
     * @param string $endDate
     * @param DailyBudget $dailyBudget
     * @param NegativeKeywords $negativeKeywords
     * @param BlockedIps $blockedIps
     * @param ExcludedSites $excludedSites
     * @param string $clientInfo
     * @param Notification $notification
     * @param TimeTargeting $timeTargeting
     * @param string $timeZone
     * @param TextCampaign $textCampaign
     * @param DynamicTextCampaign $dynamicTextCampaign
     * @param MobileAppCampaign $mobileAppCampaign
     * @param Statistics $statistics
     * @param string $type
     * @param string $status
     * @param string $state
     * @param string $statusPayment
     * @param string $statusClarification
     * @param string $currency
     * @param FundsParam $funds
     * @param CampaignAssistant $representedBy
     */
    public function __construct
    (
        int $id = null, string $name = null, string $startDate = null, string $endDate = null, DailyBudget $dailyBudget = null,
        NegativeKeywords $negativeKeywords = null, BlockedIps $blockedIps = null, ExcludedSites $excludedSites = null,
        string $clientInfo = null, Notification $notification = null, TimeTargeting $timeTargeting = null,
        string $timeZone = null, TextCampaign $textCampaign = null, DynamicTextCampaign $dynamicTextCampaign = null,
        MobileAppCampaign $mobileAppCampaign = null, Statistics $statistics = null, string $type = null, string $status = null,
        string $state = null, string $statusPayment = null, string $statusClarification = null, string $currency = null,
        FundsParam $funds = null, CampaignAssistant $representedBy = null
    )
    {
        parent::__construct([]);

        $this->setAttributes(func_get_args());
    }
}