
#### `DESIGN_AND_PERFORMANCE.md`

```markdown
# Design Choices and Performance Tuning

## Design Choices

### Code Design
1. **MVC Architecture**: The application uses Laravel’s MVC architecture to separate concerns:
   - **Models**: Represent the data and business logic (e.g., `Book`, `Author`).
   - **Controllers**: Handle HTTP requests and responses (e.g., `BookController`, `AuthorController`).
   - **Resources**: Format the JSON responses (e.g., `BookResource`, `AuthorResource`).

2. **Factory Pattern**: Used to generate dummy data for testing with `BookFactory` and `AuthorFactory`.

3. **Validation**: Custom form requests (`StoreBookRequest`, `StoreAuthorRequest`) ensure that incoming data is validated before reaching the controller.

### Database Design
1. **Schema Design**: The database schema includes `books` and `authors` tables with proper relationships.
   - **Books**: `title`, `description`, `publish_date`, `author_id`
   - **Authors**: `name`, `bio`, `birth_date`

2. **Normalization**: The schema avoids data redundancy by using foreign keys to link books with authors.

## Performance Tuning

1. **Query Optimization**
   - **Eager Loading**: Used `with('relation')` to reduce the number of queries for fetching related models, such as `Author` in `BookResource`.

2. **Caching**
   - **Cache Responses**: Used `Cache::remember` to cache frequently accessed endpoints, such as the list of authors and books, to reduce database load.

3. **Pagination**
   - **Paginate Results**: Implemented pagination with Laravel’s built-in `paginate` method to handle large datasets efficiently.

4. **Indexing**
   - **Database Indexes**: Ensured that appropriate indexes are added to columns frequently used in queries (e.g., `author_id` in the `books` table).
