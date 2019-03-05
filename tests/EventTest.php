<?php

use Mockery as m;
use MatthijsThoolen\ResourceWatcher\Event;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase {


    protected function tearDown() : void
	{
		m::close();
	}


	public function testCanGetEventCode()
	{
		$resource = m::mock('MatthijsThoolen\ResourceWatcher\Resource\ResourceInterface');
		$event = new Event($resource, Event::RESOURCE_CREATED);
		$this->assertEquals(Event::RESOURCE_CREATED, $event->getCode());
	}


	public function testCanGetResourceFromEvent()
	{
		$resource = m::mock('MatthijsThoolen\ResourceWatcher\Resource\ResourceInterface');
		$event = new Event($resource, Event::RESOURCE_CREATED);
		$this->assertInstanceOf('MatthijsThoolen\ResourceWatcher\Resource\ResourceInterface', $event->getResource());
	}


}