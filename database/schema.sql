drop table if exists contests;
create table contests (
  id int unsigned not null auto_increment primary key,
  modified timestamp,
  start_date datetime not null,
  end_date datetime not null,
  index(start_date),
  index(end_date)
) ENGINE=MyISAM;

drop table if exists prizes;
create table prizes (
  id int unsigned not null auto_increment primary key,
  modified timestamp,
  name varchar(255) not null,
  value decimal(10,2) null,
  place int signed not null,
  num_winners int signed not null,
  link varchar(255) null,
  index(name)
) ENGINE=MyISAM;

drop table if exists prize_schedule;
create table prize_schedule (
  id int unsigned not null auto_increment primary key,
  modified timestamp,
  prize_id int unsigned not null,
  contest_id int unsigned not null,
  win_date datetime not null,
  index(prize_id),
  index(contest_id)
) ENGINE=MyISAM;


drop table if exists winners;
create table winners (
  id int unsigned not null auto_increment primary key,
  modified timestamp,
  prize_schedule_id int unsigned not null,
  player_id int unsigned not null,
  first_name varchar(255) null,
  last_name varchar(255) null,
  address varchar(255) null,
  city varchar(255) null,
  state varchar(255) null,
  index(prize_schedule_id),
  index(player_id)
) ENGINE=MyISAM;

drop table if exists referral_winners;
create table referral_winners (
  id int unsigned not null auto_increment primary key,
  modified timestamp,
  winner_id int unsigned not null,
  friend_id int unsigned not null,
  status int signed not null default 0,
  first_name varchar(255) null,
  last_name varchar(255) null,
  address varchar(255) null,
  city varchar(255) null,
  state varchar(255) null,
  index(winner_id),
  index(friend_id)
) ENGINE=MyISAM;

drop table if exists players;
create table players (
  id int unsigned not null auto_increment primary key,
  modified timestamp,
  facebook_id int unsigned not null,
  username varchar(255) null,
  email_address varchar(255) null,
  friend_id int unsigned null,
  last_played datetime null,
  liked int signed default 0 not null,
  index(facebook_id)
) ENGINE=MyISAM;