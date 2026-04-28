create table users (
    id integer primary key autoincrement,
    name varchar(200) not null,
    email varchar(255) not null unique,
    password text not null,
    role text not null default 'user'
);

create table categories (
    id integer primary key autoincrement,
    name varchar(100) not null unique
);

create table posts (
    id integer primary key autoincrement,
    title varchar(200) not null,
    image text,
    content text,
    created_at datetime default current_timestamp,
    user_id integer,
    category_id integer,
    foreign key (user_id) references users(id) on delete cascade,
    foreign key (category_id) references categories(id) on delete set null
);

insert into categories (name) values
    ('Technology'),
    ('Science'),
    ('Health'),
    ('Business'),
    ('Culture'),
    ('Sports'),
    ('Travel'),
    ('Food'),
    ('Story'),
    ('Other');
