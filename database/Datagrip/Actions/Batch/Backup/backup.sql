#set context
use copy_db;

# Backup users
drop table if exists copy_db.copy_users;

create table copy_db.copy_users like tipsmoto.users;

insert into copy_db.copy_users
select * from tipsmoto.users;

#Back up teams
drop table if exists copy_db.copy_teams;

create table copy_db.copy_teams like tipsmoto.teams;

insert into copy_db.copy_teams
select * from tipsmoto.teams;

#Back up tips
drop table if exists copy_db.copy_tips;

create table copy_db.copy_tips like tipsmoto.tips;

insert into copy_db.copy_tips
select * from tipsmoto.tips;


