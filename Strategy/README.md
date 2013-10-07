Strategy
================

The strategy pattern is essentially a system for for pluggable logic, designed to be easily switched out giving varying implementations of the same task.

This pattern is often used in sorting and filtering scenarios. It may also be used for data storage / persistance, and in a more concrete definition, adapters.

Scenario
--------

You have a collection of business objects that represent items for sale in a shopping cart system. You may want to allow users to narrow results in the view layer by various different criteria, depending on their tastes.