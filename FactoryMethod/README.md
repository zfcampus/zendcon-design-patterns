Factory Method
==============

Definition
----------

The essence of the Factory Method Pattern is to "implement the concept of factories and deals with the problem of creating objects (products) without specifying the exact class of object that will be created."

In Depth
--------

This pattern is highly useful in situations where creating an actual concrete object is complex/expensive or the target concrete type is unknown to the caller.

when integrating separate systems.  On one side, there is a framework that is providing significant value by solving the most common aspects of a problem.  On the other side is the framework consumer who wants to build on the framework to fulfill specific use cases.  Since the framework can't fully imagine all possible use cases, the framework plans for this ability to extend through abstraction.  One such abstraction for object creation is a Factory Method.

In this particular pattern, the framework does not have to be burdened with how specific instances of a particular concrete type are created, it simply abstracts the creation into an interface that the framework consumer can them implement.  The end result is framework consumer can fulfill his specific use cases surrounding object/instance creation in his own way, while leveraging the wholesale value added by the framework.

Scenario
--------

From the Framework side perspective:

You want to build a shopping cart framework, but you don't want to create concrete product model objects because you want your consumers to provide both the factory for product model objects as well as those speific product model objects.

Frome the consumer side perspective:

You want to be able to build your product object model without having to extend a base product model provided by a shopping cart system.  Ideally, you can develop your own product object model and simply introduce a mechanism into the shopping cart framework that can then consume these product objects.