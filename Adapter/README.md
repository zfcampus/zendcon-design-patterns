Adapter
=======

Adapters are used to take the public API's of classes that would not otherwise be compatible, and layer on top of them a common interface. Generally, the adapter class will contain a reference to a concrete instance of the adaptee.

Examples of adapters include: Database adapters / drivers, cache adapters, and third-party API adapters.

Scenario
--------

Your want to accept payments online from both paypal and standard credit cards, but the APIs for this are quite different.