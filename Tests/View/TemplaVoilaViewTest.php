<?php

class Tx_ExtbaseTemplavoila_View_TemplaVoilaViewTest extends Tx_Extbase_BaseTestCase {
	
	private $subject;
	
	public function setUp() {
		$this->subject = new Tx_ExtbaseTemplavoila_View_TemplaVoilaView();
	}
	
	/**
	 * @test
	 */
	public function createXMLFromTemplateVarsReturnsCorrectFlexForm() {
		$expectedXmlFile = t3lib_extMgm::extPath('extbase_templavoila') .'Tests/Fixtures/templaVoilaView_1.xml';
		
		/* @var $mock Tx_ExtbaseTemplavoila_View_TemplaVoilaView */
		$mock = $this->buildAccessibleProxy('Tx_ExtbaseTemplavoila_View_TemplaVoilaView');
		$stub = t3lib_div::makeInstance($mock);
		
		$stub
			->assign('subtitle', 'Gebrauchtes')
			->assign('title', 'Nautilus 802 für 1.999 €')
			->assign('image', 'bw-teaser-nautilus_01.jpg')
			->assign('description', '<b>Nautilus 802 Kirsche in TOP Zustand!</b><br />für 1.998 € /Stückpreis<br />Farbe: Kirshce Natur<br />Erstkauf: 08.2005')
			->assign('link', 59);
		
		$this->assertXmlStringEqualsXmlFile( $expectedXmlFile, $stub->createXMLFromTemplateVars());
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 * @test
	 */
	public function settingInvalidDSthrowsException() {
		$this->subject->setDataStructure('iDontExist');
	}
}