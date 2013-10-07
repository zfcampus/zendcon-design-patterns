Mapper
======

Mapper patterns are used to translate data from one state into another. Most often, mappers are used to convert "flat" data into an object graph, or vice-versa, as you would do when savnig and retrieving objects from a database. The key point of the mapper pattern is that the objects don't need to be aware of the interfaces of the other states that the mapper may be aware of.

Mappers also promote loose coupling and separation of concerns. Many ORM systems use a datamapper pattern. Doctrine 2.x uses datamappers, whereas Doctrine 1.x used an ActiveRecord pattern, which does not allow for separation of business logic and persistence.

Scenario
--------

Data from a database (in associative array form) needs to be converted into model objects. At some point in the future, those objects need to be mapped back into associative array form to be written back to the database.