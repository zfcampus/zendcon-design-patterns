Prototype
=========

The prototype pattern is a creational design pattern. It is used when the type of objects to create is determined by a prototypical instance, which is cloned to produce new objects.

Definition
----------

This pattern is used to:

* avoid subclasses of an object creator in the client application, like the abstract factory pattern does.
* avoid the inherent cost of creating a new object in the standard way (e.g., using the 'new' keyword) when it is prohibitively expensive for a given application.

Prohibitively expensive could mean that the object's creation workflow is too involved or it could mean that computationally "cloning" an existing object is less expensive than using the "new" operator.  This is especially useful when you want to deal with sets of objects that have a small amount of variation but might also share a set of dependencies.

Scenario
--------

Similar to the Factory Method, we want to delegate the creation of a particular object type to the consumer.  Instead of using a factory, and because we know there will be a large set of these objects the might have wired dependencies, this particular extension point will use prototypical object creation: the prototype pattern.