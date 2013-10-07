Visitor
=======

Definition
----------

The Visitor design pattern is a way of separating an algorithm from an object structure on which it operates. A practical result of this separation is the ability to add new operations to existing object structures without modifying those structures. It is one way to follow the open/closed principle.

In essence, the visitor allows one to add new virtual functions to a family of classes without modifying the classes themselves; instead, one creates a visitor class that implements all of the appropriate specializations of the virtual function. The visitor takes the instance reference as input, and implements the goal through double dispatch.

Scenario
--------

We want to implement a simple data structure that manages GET or POST input data, being it single or multiple values. We want to implement a pair of Visitor pattern to define operations on these data structures.
