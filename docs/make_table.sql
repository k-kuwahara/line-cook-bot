# create database
CREATE DATABASE IF NOT EXISTS `db_name` CHARACTER SET utf8;

# set db_name
use db_name;

# create tables
CREATE TABLE IF NOT EXISTS `category`(
   `category_id`        INT(11) AUTO_INCREMENT NOT NULL COMMENT 'カテゴリID',
   `category_name`      VARCHAR(255)           NOT NULL COMMENT 'カテゴリ名',
   `parent_category_id` INT(11)   DEFAULT 1    NOT NULL COMMENT '親カテゴリID',
   `rank`               INT(11)   DEFAULT 1    NOT NULL COMMENT '親カテゴリID',
   PRIMARY KEY (`category_id`)
) DEFAULT CHARSET=utf8 COMMENT='カテゴリテーブル';

CREATE TABLE IF NOT EXISTS `cooks`(
   `cook_id`     SMALLINT(6) AUTO_INCREMENT NOT NULL COMMENt '料理ID',
   `category_id` SMALLINT(6)                NOT NULL COMMENt 'カテゴリID',
   `cook_name`   VARCHAR(255)               NOT NULL COMMENT '料理名',
   PRIMARY KEY (`cook_id`)
) DEFAULT CHARSET=utf8 COMMENT='料理一覧';
