<?php

if ( ! defined( 'ABSPATH' ) ){
	exit;
}

class Nexcess_Add_To_Team_Trigger extends AutomateWoo\Trigger{

/**
	 * Define which data items are set by this trigger, this determines which rules and actions will be available
	 *
	 * @var array
	 */
	public $supplied_data_items = array( 'customer' );

	/**
	 * Set up the trigger
	 */
	public function init() {
		$this->title = __( 'User Added to Team', 'automatewoo-custom' );
		$this->group = __( 'Teams', 'automatewoo-custom' );
	}

	/**
	 * Add any fields to the trigger (optional)
	 */
	public function load_fields() {}

	/**
	 * Defines when the trigger is run
	 */
	public function register_hooks() {
		add_action( 'wc_memberships_for_teams_add_team_member', array( $this, 'catch_hooks' ) );
	}

	/**
	 * Catches the action and calls the maybe_run() method.
	 *
	 * @param $user_id
	 */
	public function catch_hooks( $user_id ) {

		// get/create customer object from the user id
		$customer = AutomateWoo\Customer_Factory::get_by_user_id( absint( $user_id ) );

		$this->maybe_run(array(
			'customer' => $customer,
		));
	}

	/**
	 * Performs any validation if required. If this method returns true the trigger will fire.
	 *
	 * @param $workflow AutomateWoo\Workflow
	 * @return bool
	 */
	public function validate_workflow( $workflow ) {

		// Get objects from the data layer
		$customer = $workflow->data_layer()->get_customer();

		// do something...

		return true;
	}

} // Nexcess_Add_To_Team_Trigger
