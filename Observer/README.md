Observer
=====

The observer pattern is used to promote loose coupling between objects. "Subjects" may be subscribed to by "Observers", such that hanges to the subject trigger a notification to one or more observers. Usually, the observers are passed the entire subject as context.

Scenario
--------

A data model may be changed from various different points in the code. You want to implement a logger that keeps track of when the model changes.