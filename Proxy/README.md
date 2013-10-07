Proxy
=====

Definition
----------
A proxy, in its most general form, is a class functioning as an interface to something else. The proxy could interface to anything: a network connection, a large object in memory, a file, or some other resource that is expensive or impossible to duplicate.

In situations where multiple copies of a complex object must exist, the proxy pattern can be adapted to incorporate the flyweight pattern in order to reduce the application's memory footprint. Typically, one instance of the complex object and multiple proxy objects are created, all of which contain a reference to the single original complex object

Scenario
--------
Imagine you have an Image class that loads the file on constructor. We want to create a Proxy class that loads the image only if needed, for instance only during the dispaly.
