<?php

require_once 'TestHelper.php';

class EpaPlugins_UnitTests_MetaEventNamePluginTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->plugin = new \EpaPlugins\MetaEventNamePlugin();
    }

    /**
     * @test
     */
    public function registersHandlers()
    {
        $eventDispatcher = $this->getMock('Epa\\Api\\EventDispatcher');
        $eventDispatcher
            ->expects($this->once())
            ->method('registerForEvent')
            ->with('Epa\\Api\\NewEventEvent', function () {});

        $this->plugin->registerHandlers($eventDispatcher);
    }

    /**
     * @test
     */
    public function addsDocCommentNameOfEventClass()
    {
        $newEventEvent = $this->getMock('Epa\\Api\\NewEventEvent');
        $newEventEvent
            ->expects($this->once())
            ->method('addName')
            ->with('Foo');
        $newEventEvent
            ->expects($this->once())
            ->method('getEventNames')
            ->will($this->returnValue(array(
                'EpaPlugins\\UnitTests\\Support\\EventClass',
            )));

        $this->plugin->handleEvent($newEventEvent);
    }

    /**
     * @test
     */
    public function addsInterfaceWithEventDocCommentAsEventName()
    {
        $newEventEvent = $this->getMock('Epa\\Api\\NewEventEvent');
        $newEventEvent
            ->expects($this->once())
            ->method('addName')
            ->with('Foo');
        $newEventEvent
            ->expects($this->once())
            ->method('getEventNames')
            ->will($this->returnValue(array(
                'EpaPlugins\\UnitTests\\Support\\InterfaceWithDocCommentEvent',
            )));

        $this->plugin->handleEvent($newEventEvent);
    }

    /**
     * @test
     */
    public function addsDocCommentEventNameOfAbstractClass()
    {
        $newEventEvent = $this->getMock('Epa\\Api\\NewEventEvent');
        $newEventEvent
            ->expects($this->once())
            ->method('addName')
            ->with('AbstractEvent');
        $newEventEvent
            ->expects($this->once())
            ->method('getEventNames')
            ->will($this->returnValue(array(
                'EpaPlugins\\UnitTests\\Support\\EventExtendingAbstractClassWithEventName',
            )));

        $this->plugin->handleEvent($newEventEvent);
    }

    /**
     * @test
     */
    public function addsDocCommentEventNameOfClassExtendingOtherClass()
    {
        $newEventEvent = $this->getMock('Epa\\Api\\NewEventEvent');
        $newEventEvent
            ->expects($this->once())
            ->method('addName')
            ->with('ExtendedEvent');
        $newEventEvent
            ->expects($this->once())
            ->method('getEventNames')
            ->will($this->returnValue(array(
                'EpaPlugins\\UnitTests\\Support\\ExtendingClass',
            )));

        $this->plugin->handleEvent($newEventEvent);
    }
}
