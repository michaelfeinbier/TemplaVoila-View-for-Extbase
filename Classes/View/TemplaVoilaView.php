<?php
require_once(t3lib_extMgm::extPath('templavoila').'class.tx_templavoila_htmlmarkup.php');
require_once(PATH_t3lib . 'class.t3lib_flexformtools.php');
require_once(t3lib_extMgm::extPath('templavoila').'pi1/class.tx_templavoila_pi1.php');

/**
 * Renders Output via TemplaVoila DS/TO
 * 
 * @author     Michael Feinbier
 * @version    SVN: $Id$
 * @package    Extbase_templavoila
 * @subpackage View
 */
class Tx_ExtbaseTemplavoila_View_TemplaVoilaView extends Tx_Extbase_MVC_View_AbstractView {
	
	/**
	 * The Datastructure
	 * @var tx_templavoila_datastructure
	 */
	protected $dataStructure;
	
	protected $dataStructureString;


	protected $templateObject;

	/**
	 *
	 * @var tx_templavoila_datastructureRepository
	 */
	protected $datastructureRepository;
	
	/**
	 * The Main TemplaVoila Element
	 * @var tx_templavoila_pi1
	 */
	protected $templaVoila;


	public function __construct() {
		$this->datastructureRepository = t3lib_div::makeInstance('tx_templavoila_datastructureRepository');
		$this->templaVoila             = t3lib_div::makeInstance('tx_templavoila_pi1');
	}

	/**
	 * Renders 
	 * @return type 
	 */
	public function render() {
		if( !$this->dataStructure) {
			throw new Tx_ExtbaseTemplavoila_Exception_InvalidConfigurationException('No datastructure set', 1291299924);
		}
		
		if( !$this->templateObject) {
			throw new Tx_ExtbaseTemplavoila_Exception_InvalidConfigurationException('No Template Object set', 1291299991);
		}
		
		$renderData = array(
			'tx_templavoila_ds'   => $this->dataStructureString,
			'tx_templavoila_to'   => $this->templateObject,
			'tx_templavoila_flex' => $this->createXMLFromTemplateVars(),
		);
		
		return $this->templaVoila->renderElement($renderData, 'tt_content');
	}
	
	/**
	 * Creates the XML-based Flexform of all assigned
	 * template variables
	 * @return xml
	 */
	public function createXMLFromTemplateVars() {
		$flexFormArray = array();
		foreach ($this->variables AS $name => $value) {
			$flexFormArray['data']['sDEF']['lDEF'][$name]['vDEF'] = $value;
		}

		$flexFormTools = t3lib_div::makeInstance('t3lib_flexformtools');
        return $flexFormTools->flexArray2xml($flexFormArray);
	}
	
	
	public function setDataStructure($dsString) {
		$this->dataStructureString = $dsString;
		$this->dataStructure = $this->datastructureRepository->getDatastructureByUidOrFilename( $dsString );
		if( !$this->dataStructure instanceof tx_templavoila_datastructure ) {
			throw new Tx_ExtbaseTemplavoila_Exception_InvalidConfigurationException('The DS "' . $dsString . '" was not found', 1291300487 );
		}
	}

}