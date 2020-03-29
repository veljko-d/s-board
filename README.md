# s-board
School Board project (test) built with my "m-frame" micro framework.

#### Requirements
- PHP v.7.4+
- MySQL v.5.7

#### Installation

Clone the project:

```bash
git clone https://github.com/veljko-d/s-board.git
```

Install composer dependencies:

```bash
composer update
```

There is no database migrations implemented.

Dump database file `s-board.sql` is provided inside the `db/dump` folder with required tables and data.
Create `s-board` schema and import the sql file.

Or you can do it your own way...

Add `s-board.test` domain inside your hosts file.

#### Run project

To see the results, type in your browser: `s-board.test/students/{number}`
