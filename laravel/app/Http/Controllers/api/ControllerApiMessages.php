<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\api\ServicesApiMessages;
use Illuminate\Http\Request;

/**
 * Class ControllerApiConversation
 * @package App\Http\Controllers
 * @author  Edwin Renz Mateo
 */
class ControllerApiMessages extends Controller
{
    /**
     * Object for ServicesApiConversation
     * @var $oServicesApiConversation
     */
    protected $oServicesApiMessages;

    /**
     * ControllerApiConversation constructor.
     * @param ServiceAppSettingManagement $oServiceAppSettingManagement
     */
    public function __construct(ServicesApiMessages $oServicesApiMessages)
    {
        $this->oServicesApiMessages = $oServicesApiMessages;
    }

    public function getMessages()
    {
        $aRequest = json_decode(request()->getContent(), true);
        return $this->oServicesApiMessages->getMessages($aRequest);
    }
}
