<?php

namespace App\Services\api;

use Exception;

/**
 * Class ServicesApiMessages
 * @package App\Http\Services\api
 * @author Edwin Renz Mateo
 */
class ServicesApiMessages
{
    /**
     * Message to compare
     */
    private $aMessages = ['hello', 'hi', 'goodbye', 'bye'];

    /**
     * Return a message if the request message is right
     * @param array $aMessage
     * @return array|string
     */
    public function getMessages($aMessage)
    {
        try {
            $this->checkValuesIfSet($aMessage);
            $aResult = $this->checkMessageResponse($aMessage['message']);

            return json_encode([
                'response_id' => $aMessage['conversation_id'],
                'response' => $aResult
            ]);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Validate if the passed parameter is set
     * @param array $aMessage
     * @throws exception
     */
    private function checkValuesIfSet($aMessage)
    {
        if (isset($aMessage['conversation_id']) === false || isset($aMessage['message']) === false) {
            throw new Exception('conversation_id and message should be present on the request');
        }
    }

    /**
     * Check if message matches and return corresponding response
     * @param array $aMessage
     * @return string
     */
    private function checkMessageResponse($sMessage)
    {
        preg_match_all('~\w+(?:-\w+)*~', strtolower($sMessage), $aResult);

        $aMatchResult = array_values(array_intersect($aResult[0], $this->aMessages));

        if (empty($aMatchResult) === true) {
            return 'Sorry, I dont Understand.';
        }

        if ($aMatchResult[0] === 'hello' || $aMatchResult[0] === 'hi') {
            return 'Welcome to StationFive.';
        }

        if ($aMatchResult[0] === 'goodbye' || $aMatchResult[0] === 'bye') {
            return 'Thank you, see you around.';
        }
    }
}
