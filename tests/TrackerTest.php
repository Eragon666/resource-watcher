<?php

use Mockery as m;
use MatthijsThoolen\ResourceWatcher\Tracker;
use PHPUnit\Framework\TestCase;

class TrackerTest extends TestCase {


    protected function tearDown() : void
	{
		m::close();
	}


	public function testResourceRegisteredWithTracker()
	{
		$resource = m::mock('MatthijsThoolen\ResourceWatcher\Resource\ResourceInterface');
		$resource->shouldReceive('getKey')->twice()->andReturn('foo');
		$listener = m::mock('MatthijsThoolen\ResourceWatcher\Listener');
		$tracker = new Tracker;
		$tracker->register($resource, $listener);
		$this->assertTrue($tracker->isTracked($resource));
	}


}