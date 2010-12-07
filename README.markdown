TemplaVoila View for Extbase MVC
================================

Did you ever wanted to render a PluginOutput exactly like a FCE you created?
This is the first implementation of a TemplaVoila based View for the TYPO3 Extbase MVC Extension.
With this Extension you are able to render a predefined FCE through an Extbase Controller/Action.

* * * 
How does it work?
-----------------

Imagine a TemplaVoila FCE with a DS (DataStructure) like this
    <?xml version="1.0" encoding="utf-8" standalone="yes" ?>
    <T3DataStructure>
    	<meta type="array">
    		<langDisable type="integer">1</langDisable>
    	</meta>
    	<ROOT type="array">
    		<tx_templavoila type="array">
    			<title>Demo FCEr</title>
    			<tags>body:inner</tags>
    		</tx_templavoila>
    		<type>array</type>
    		<el type="array">
    		
    		<title type="array">
    			<tx_templavoila type="array">
    				<title>title</title>
    				<tags>h1:outer</tags>
    				<eType>input_h</eType>
    				<TypoScript>
    					<![CDATA[
    						10 = TEXT
    						10.current = 1
    						10.wrap = <h1>|</h1>
    					]]>
    				</TypoScript>
    			</tx_templavoila>
    			<TCEforms type="array">
    				<config type="array">
    					<type>input</type>
    				</config>
    				<label>Titel</label>
    			</TCEforms>
    		</title>
    	</ROOT>
    </T3DataStructure>

You use this DS together with a mapped TO as simple FCE in your Page module as always.