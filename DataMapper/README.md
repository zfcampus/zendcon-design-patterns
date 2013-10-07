DataMapper
==========

DataMapper is a data access pattern that is used to translate in-memory data from business objects into persistent storage (usually a database, but could be files, api, etc).

The key point of DataMapper is that it allows models to be storage-agnostic, or even storage-oblivious and promotes separation of concerns.

Real World Examples
-------------------

Many ORM systems use a datamapper pattern. Doctrine 2.x uses datamappers, whereas Doctrine 1.x used an ActiveRecord pattern, which does not allow for separation of business logic and persistence.