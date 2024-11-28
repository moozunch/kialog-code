-- Create users table
create table users (
    id bigserial unique primary key,
    username varchar(255) not null,
    name varchar(255) null,
    institution varchar(255) null,
    profile_image varchar(255) null,
    bio varchar(255) null,
    country varchar(255) null,
    email varchar(255) not null unique,
    email_verified_at timestamp null,
    password varchar(255) not null,
    remember_token varchar(100) null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp
);

-- Create password_reset_tokens table
create table password_reset_tokens (
    email varchar(255) primary key,
    token varchar(255) not null,
    created_at timestamp null
);

-- Create sessions table
create table sessions (
    id varchar(255) primary key,
    user_id bigint null,
    ip_address varchar(45) null,
    user_agent text null,
    payload text not null,
    last_activity int not null
);

-- Create indexes for sessions table
create index user_id_index on sessions(user_id);
create index last_activity_index on sessions(last_activity);

-- Foreign key constraint for sessions.user_id referencing users.id
alter table sessions
add constraint fk_user foreign key (user_id) references users (id) on delete set null;

-- Create topics table
create table topics (
    id bigserial primary key,
    title varchar(255) not null,
    description text not null,
    user_id bigint not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    constraint fk_user_id foreign key (user_id) references users (id) on delete cascade
);

-- Create posts table
create table posts (
    id bigserial primary key,
    message varchar(255) not null,
    images json null,
    comments int default 0,
    topic_id bigint not null,
    user_id bigint not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    constraint fk_topic_id foreign key (topic_id) references topics (id) on delete cascade,
    constraint fk_user_id foreign key (user_id) references users (id) on delete cascade
);

-- Create bookmarks table
create table bookmarks (
    id bigserial primary key,
    user_id bigint not null,
    post_id bigint not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    constraint fk_user_id foreign key (user_id) references users (id) on delete cascade,
    constraint fk_post_id foreign key (post_id) references posts (id) on delete cascade
);

-- Create post_user_likes table
create table post_user_likes (
    id bigserial primary key,
    user_id bigint not null,
    post_id bigint not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    constraint fk_user_id foreign key (user_id) references users (id) on delete cascade,
    constraint fk_post_id foreign key (post_id) references posts (id) on delete cascade
);

-- Create conversations table
create table conversations (
    id bigserial primary key,
    user_one bigint not null,
    user_two bigint not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    constraint fk_user_one foreign key (user_one) references users (id) on delete cascade,
    constraint fk_user_two foreign key (user_two) references users (id) on delete cascade
);

-- Create user_conversations table
create table user_conversations (
    id bigserial primary key,
    user_id bigint not null,
    conversation_id bigint not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    constraint fk_user_id foreign key (user_id) references users (id) on delete cascade,
    constraint fk_conversation_id foreign key (conversation_id) references conversations (id) on delete cascade,
    unique (user_id, conversation_id)
);

-- Create messages table
create table messages (
    id bigserial primary key,
    conversation_id bigint not null,
    sender_id bigint not null,
    content text not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    constraint fk_conversation foreign key (conversation_id) references conversations (id) on delete cascade,
    constraint fk_sender foreign key (sender_id) references users (id) on delete cascade
);

-- Create read_receipts table
create table read_receipts (
    id bigserial primary key,
    message_id bigint not null,
    user_id bigint not null,
    read_at timestamp null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    constraint fk_message foreign key (message_id) references messages (id) on delete cascade,
    constraint fk_read_user foreign key (user_id) references users (id) on delete cascade,
    unique (message_id, user_id)
);

-- Create topic_user pivot table
create table topic_user (
    id bigserial primary key,
    topic_id bigint not null,
    user_id bigint not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    constraint fk_topic_id foreign key (topic_id) references topics (id) on delete cascade,
    constraint fk_user_id foreign key (user_id) references users (id) on delete cascade
);

-- Create reports table
create table reports (
    id bigserial primary key,
    user_id bigint not null,
    post_id bigint not null,
    reason text not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    constraint fk_user_id foreign key (user_id) references users (id) on delete cascade,
    constraint fk_post_id foreign key (post_id) references posts (id) on delete cascade
);

-- Create blocks table
create table blocks (
    id bigserial primary key,
    user_id bigint not null,
    blocked_user_id bigint not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    constraint fk_user_id foreign key (user_id) references users (id) on delete cascade,
    constraint fk_blocked_user_id foreign key (blocked_user_id) references users (id) on delete cascade
);

-- Create comments table
CREATE TABLE comments (
    id BIGSERIAL PRIMARY KEY, -- Primary key with auto increment (BIGSERIAL for PostgreSQL)
    post_id BIGINT NOT NULL, -- Foreign key to posts
    user_id BIGINT NOT NULL, -- Foreign key to users
    content TEXT NOT NULL, -- Column for comment content
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Created at timestamp
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Updated at timestamp
    CONSTRAINT fk_post_id FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE, -- Foreign key constraint for post_id
    CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE -- Foreign key constraint for user_id
);

-- Add trigger to automatically update the updated_at field on record updates
CREATE OR REPLACE FUNCTION update_updated_at() 
RETURNS TRIGGER AS $$
BEGIN
  NEW.updated_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER update_comments_updated_at
BEFORE UPDATE ON comments
FOR EACH ROW
EXECUTE FUNCTION update_updated_at();

 