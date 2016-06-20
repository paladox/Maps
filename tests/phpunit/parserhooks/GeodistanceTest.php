<?php

namespace Maps\Test;

use DataValues\Geo\Values\LatLongValue;
use Maps\ElementOptions;
use Maps\Elements\Location;

/**
 * @covers MapsGeodistance
 *
 * @group Maps
 * @group ParserHook
 * @group GeodistanceTest
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class GeodistanceTest extends ParserHookTest {

	/**
	 * @see ParserHookTest::getInstance
	 * @since 2.0
	 * @return \ParserHook
	 */
	protected function getInstance() {
		return new \MapsGeodistance();
	}

	/**
	 * @see ParserHookTest::parametersProvider
	 * @since 2.0
	 * @return array
	 */
	public function parametersProvider() {
		$paramLists = [];

		$paramLists[] = [
			'location1' => '4,2',
			'location2' => '42,0',
		];

		$paramLists[] = [
			'4,2',
			'42,0',
		];

		return $this->arrayWrap( $paramLists );
	}

	/**
	 * @see ParserHookTest::processingProvider
	 * @since 3.0
	 * @return array
	 */
	public function processingProvider() {
		$argLists = [];

		$location1 = new Location( new LatLongValue( 4, 2 ) );
		$location1->setTitle( '4,2' );
		$location2 = new Location( new LatLongValue( 42, 0 ) );
		$location2->setTitle( '42,0' );

		$values = [
			'location1' => '4,2',
			'location2' => '42,0',
		];

		$expected = [
			'location1' => $location1,
			'location2' => $location2,
		];

		$argLists[] = [ $values, $expected ];

		$values = [
			'location1' => '4,2',
			'location2' => '42,0',
			'unit' => '~=[,,_,,]:3',
			'decimals' => '1',
		];

		$expected = [
			'location1' => $location1,
			'location2' => $location2,
			'decimals' => 1,
		];

		$argLists[] = [ $values, $expected ];

		return $argLists;
	}

}