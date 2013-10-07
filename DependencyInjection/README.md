Dependency Injection
====================

<strike>Dependency injection is a software design pattern that allows the removal of hard-coded dependencies and makes it possible to change them, whether at run-time or compile-time.</strike>

We're actually talking about Inversion of Control.

Dependency Injection is the concept of introducing one or more dependent objects into a consuming object as to fulfill the consuming objects requirements.

Definition
----------

In practice, inversion of control / dependency injection is a style of software construction where reusable code controls the execution of problem-specific code. It carries the strong connotation that the reusable code and the problem-specific code are developed independently, which often results in a single integrated application. Inversion of control as a design guideline serves the following purposes:

* There is a decoupling of the execution of a certain task from implementation
* Every module can focus on what it is designed for
* Modules make no assumptions about what other systems do but rely on their contracts
* Replacing modules have no side effect on other modules

Hollywood Principle: "Don't call us, we'll call you".

Scenario
--------

You have many objects that need to talk to a database.  Instead of opening multiple connections to the database, which is an object, you want to maintain a single instance and single open connection.
