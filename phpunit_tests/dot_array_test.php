<?php

require_once __DIR__ . '/../dot_array.php';

class Dot_Array_Test extends PHPUnit_Framework_TestCase {
		
	protected $array = [
		'one' => '1',
		'two' => '2',
		'three' => [
			'alpha' => 'ALPHA',
			'beta' => 'BETA',
			'gamma' => [
				'alef' => 'ALEF',
				'bet' => 'BET',
				'gimmel' => [
					'1' => 'one',
					'2' => 'two',
				],
			],
			
		],
		'four' => [
			'a' => 'A',
			'b' => 'B',
		],
	];
	
	function test_getting_existent_key(){
		$dot_array = new Dot_Array($this->array);
		$this->assertEquals($dot_array->get(), $this->array);
		$this->assertEquals($dot_array->get('one'), '1');
		$this->assertEquals($dot_array->get('three.alpha'), 'ALPHA');
		$this->assertEquals($dot_array->get('three.gamma.bet'), 'BET');
		$this->assertEquals($dot_array->get('three.gamma.gimmel.1'), 'one');
	}
	
	/*
	function test_getting_nonexistent_key(){
		$dot_array = new Dot_Array($this->array);
		$dot_array->get('four');
		$dot_array->get('one.delta');
		$dot_array->get('three.delta');
		$dot_array->get('four.delta');
	}
	*/
	
	function test_setting(){
		$dot_array = (new Dot_Array($this->array))
			->set('two', '3')
			->set('three.gamma.bet', 'DALET');
		$this->assertEquals($dot_array->get('two'), '3');
		$this->assertEquals($dot_array->get('three.gamma.bet'), 'DALET');
		$this->assertNotEquals($dot_array->get(), $this->array);
	}
}

