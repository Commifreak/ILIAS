<?php
/**
 * Class JSDropzoneInitializer
 *
 * Generates the javascript code to initialize a dropzone.
 *
 * @author  nmaerchy
 * @date    22.05.17
 * @version 0.0.2
 *
 * @package ILIAS\UI\Implementation\Component\Dropzone
 */

namespace ILIAS\UI\Implementation\Component\Dropzone;

class JSDropzoneInitializer {

	/**
	 * @var SimpleDropzone $dropzone
	 */
	private $dropzone;


	/**
	 * JSDropzoneInitializer constructor.
	 *
	 * @param SimpleDropzone $dropzone a wrapper class for dropzones
	 */
	public function __construct(SimpleDropzone $dropzone) { $this->dropzone = $dropzone; }


	/**
	 * Generates the javascript code to initialize a dropzone.
	 *
	 * @return string the generated code
	 */
	public function initDropzone() {

		$darkenedBackground = $this->dropzone->isDarkenedBackground()? "true" : "false";

		return "
		
			il.UI.dropzone.initializeDropzone(\"{$this->dropzone->getType()}\", {
			
				\"id\": \"{$this->dropzone->getId()}\",
				\"darkenedBackground\": {$darkenedBackground},
				\"registeredSignals\": [{$this->getRegisteredSignals()}]
			});
		";

	}


	/**
	 * @return string the registered signals as comma separated string
	 */
	private function getRegisteredSignals() {

		$registeredSignalList = array();

		foreach ($this->dropzone->getRegisteredSignals() as $registeredSignal) {

			$signal = $registeredSignal->getSignal();
			array_push($registeredSignalList, $signal);
		}

		return implode(",", $registeredSignalList);
	}
}