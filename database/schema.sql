create table users (
    id integer primary key autoincrement,
    name varchar(200) not null,
    email varchar(255) not null,
    password varchar(100) not null
);

create table posts (
    id integer primary key autoincrement,
    title varchar(200) not null,
    image text,
    content varchar(255),
    created_at datetime default current_timestamp,
    user_id integer,
    foreign key (user_id) references users(id)
);