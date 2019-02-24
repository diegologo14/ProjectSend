<?php
/**
 * Get custom system options from the database
 */

namespace ProjectSend\Classes;

class Options extends Base
{
    public $options;
    public $dbh;
    public $container;

    function __construct($container)
    {
        parent::__construct($container);
    }

    /**
	 * Gets the values from the options table, which has 2 columns.
	 * The first one is the option name, and the second is the assigned value.
	 *
	 * @return array
	 */
	private function get()
	{
		$this->options = array();
		try {
			$this->query = $this->dbh->query("SELECT * FROM " . TABLE_OPTIONS);
			$this->query->setFetchMode(\PDO::FETCH_ASSOC);

			if ( $this->query->rowCount() > 0) {
				while ( $this->row = $this->query->fetch() ) {
					$this->options[$this->row['name']] = $this->row['value'];
				}
			}

			return $this->options;
		}
		catch ( Exception $e ) {
			return false;
        }
	}

	/**
	 * Makes the options available to the app
	 */
	public function retrieve()
	{
		$this->options = $this->get();

		/** In case an option should not be set as a const */
		$this->exceptions = [
		];

		/** @todo Hacky! Replace? */
		$this->replacements = [
			//'last_update'   => 'convert_old_version_number',
		];
		
		if ( !empty( $this->options ) ) {
			/**
			 * Set a const for each value on the options table
			 */
			foreach ( $this->options as $this->name => $this->value ) {
				if ( in_array( $this->name, $this->exceptions ) ) {
					continue;
				}

				if ( array_key_exists( $this->name, $this->replacements ) ) {
					$this->callback = $this->replacements[$this->name];
					$this->value = call_user_func( $this->callback, $this->value );
				}

				$const = strtoupper( $this->name );
				define( $const, $this->value );
			}

			/**
			 * Set the default timezone based on the value of the Timezone select box
			 * of the options page.
			 */
			date_default_timezone_set(TIMEZONE);

		} else {
			define('BASE_URI', '/');
        }
	}

	/**
	 * Save to the database
	 */
	public function save($options)
	{
	}

    /**
    * Versions prior to 1.0 used the number of the current commit, with a preceding "r"
    * as Google Code used to do.
    * If the currently installed version is indeed named like this, then the extracted
    * number from the version is converted to 0.{version}, which will force the
    * updating process.
    */
    function convert_old_version_number(Request $request, Response $response)
    {
        $v = ( str_pad($v, 4, "0", STR_PAD_LEFT) ) / 10000;
        return $v;
    }
}