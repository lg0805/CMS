<?php

require_once 'db.inc.php';

// 创建数据库
$query = "CREATE DATABASE IF NOT EXISTS cms DEFAULT CHARSET UTF8";
mysqli_query($db, $query);

// 创建数据表
$query = "CREATE TABLE IF NOT EXISTS cms_access_levels(
			access_level TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
			access_name VARCHAR(50) NOT NULL DEFAULT '',

			PRIMARY KEY(access_level))
			ENGINE MyISAM";

mysqli_query($db, $query) or die(mysqli_error($db));

// 给数据表填充内容
$query = "INSERT IGNORE INTO cms_access_levels
			(access_level, access_name) 
			VALUES
			(1, 'user'),
			(2, 'moderator'),
			(3, 'administrator')";

mysqli_query($db, $query) or die(mysqli_error($db));


$query = "CREATE TABLE IF NOT EXISTS cms_users(
			user_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
			email VARCHAR(100) NOT NULL UNIQUE,
			password CHAR(41) NOT NULL,
			name VARCHAR(100) NOT NULL,
			access_level TINYINT UNSIGNED NOT NULL DEFAULT 1,

			PRIMARY KEY(user_id))
			ENGINE=MyISAM";

mysqli_query($db, $query) or die(mysqli_error($db));

$query = "INSERT IGNORE INTO cms_users
			(user_id, email, password, name, access_level) 
			VALUES
			(NULL, 'admin@example.com', PASSWORD('secret'), 'administrator', 3)";

mysqli_query($db, $query) or die(mysqli_error($db));


$query = "CREATE TABLE IF NOT EXISTS cms_articles(
	article_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INTEGER UNSIGNED not null,
	is_published boolean not null default false,
	submit_date datetime not null,
	publish_date datetime,
	title VARCHAR(255) not null,
	article_text mediumtext,

	primary key(article_id),
	foreign key(user_id) references cms_users(user_id),
	index(user_id, submit_date),
	fulltext index(title, article_text))engine=MyISAM";

mysqli_query($db, $query) or die(mysqli_error());


$query = "CREATE TABLE IF NOT EXISTS cms_comments(
		comment_id integer unsigned not null AUTO_INCREMENT,
		article_id integer unsigned not null ,
		user_id integer unsigned not null,
		comment_date datetime not null,
		comment_text mediumtext,

		primary key(comment_id),
		foreign key(article_id) references cms_articles(article_id),
		foreign key(user_id) references cms_users(user_id))engine=MyISAM";
mysqli_query($db, $query) or die(mysqli_error($db));

echo 'Success!';