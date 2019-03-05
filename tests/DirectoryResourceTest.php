<?php

use Mockery as m;
use Illuminate\Filesystem\Filesystem;
use MatthijsThoolen\ResourceWatcher\Event;
use MatthijsThoolen\ResourceWatcher\Resource\DirectoryResource;
use PHPUnit\Framework\TestCase;

class DirectoryResourceTest extends TestCase {


	protected function tearDown() : void
	{
		m::close();
	}


	public function testDescendantDetection()
	{
		$files = new Filesystem;
		$resource = new DirectoryResource(new SplFileInfo(__DIR__), $files);
		$resource->setupDirectory();
		$this->assertEquals(6, count($resource->getDescendants()));
	}


	public function testDetectingOfDirectoryResourceEvents()
	{
		$files = m::mock('Illuminate\Filesystem\Filesystem');
		$files->shouldReceive('exists')->times(20)->andReturn(false, true);
		$files->shouldReceive('lastModified')->times(19)->andReturn(time());

		$resource = new DirectoryResource(new SplFileInfo(__DIR__), $files);
		$resource->setupDirectory();

		$events = $resource->detectChanges();
		$this->assertInstanceOf('MatthijsThoolen\ResourceWatcher\Event', $event = array_pop($events));
		$this->assertEquals(Event::RESOURCE_CREATED, $event->getCode());
	}


}