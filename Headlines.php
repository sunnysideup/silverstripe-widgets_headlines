<?php

/**
 * @author nicolaas [at] sunnysideup.co.nz
 **/
class Headlines extends Widget {

	private static $db = array(
		'NumberOfHeadlinesShown' => 'Int'
	);

	private static $defaults = array(
		'NumberOfHeadlinesShown' => 5
	);

	private static $boolean_field_used_to_identify_headline = '';

	private static $title = 'Headlines';

	private static $cmsTitle = 'Headlines';

	private static $description = 'Adds a list of identified headlines';

	function getCMSFields() {
		return new FieldList(
			new NumericField('NumberOfHeadlinesShown', 'Number of Headlines Shown')
		);
	}

	function Links() {
		Requirements::themedCSS('widgets_headlines');
		$entries = BlogEntry::get()->sort('Date', 'DESC')->limit($this->NumberOfHeadlinesShown);
		if($field = $this->Config()->get("boolean_field_used_to_identify_headline")) {
			$entries = $entries->filter($this->Config()->get("boolean_field_used_to_identify_headline"), 1);
		}
		return $entries;
	}
}
