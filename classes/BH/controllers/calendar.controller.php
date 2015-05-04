<?php

/**
 * BluHorn CALENDAR CLASS
 *  
 * @author Andrew Stonecipher
 * @link http://www.BluHorn.com
 * @license Part of Filelogix usage license
 */
namespace BH\Controllers;

require_once ('/lib/recaptcha/recaptchalib.php');

class calendar extends \controller
{
    // Will store database connection here
	private $db;
	private $connID;
	private $sessionID;
	private $userID;
	private $agencyID;
	private $view = "calendar";
	private $auth;
	private $vars = array("activeSideBar"=>array("campaigns"=>"active"));

    /**
     * Create instance, load current info based on session info
     *
     * @return bool
     */
    public function __construct($db, $sessionID, $userID)
    {
        $this->db = $db;
        $this->sessionID = $sessionID;
        $this->auth = new \auth($db);
        $this->userID = $this->auth->getUserID();
    }

    public function data()
    {
        return $this->vars;
    }


    public function view()
    {
        return $this->view;
    }

    public function getCampaigns()
    {
        $campaigns = new \BH\campaign($this->db, $this->agencyID, $this->userID);
        
        $query = $campaigns->getRecentCampaigns();
        
        error_log( "Calendar Controller, getCampaigns: " . $this->db->lastQuery());
        error_log(json_encode( $query ));
        return json_encode( $query );
    }
}
?>
