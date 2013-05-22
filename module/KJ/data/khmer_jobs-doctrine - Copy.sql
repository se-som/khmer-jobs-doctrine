
CREATE TABLE b_category (
	cat_id  int(11) unsigned not null auto_increment,
	cat_name varchar(255) null default '',
	
	PRIMARY KEY (cat_id)
)ENGINE=InnoDB;

CREATE TABLE b_jobcategory (
	jcat_id int(11) unsigned not null auto_increment,
	com_id int(11) NOT NULL,
	cat_id int(11) unsigned not null,
	
	FOREIGN KEY(com_id) REFERENCES a_company(com_id) ON DELETE CASCADE,
	FOREIGN KEY(cat_id) REFERENCES b_category(cat_id) ON DELETE CASCADE,
	
	PRIMARY KEY (jcat_id)
)ENGINE=InnoDB;

CREATE TABLE b_job (
	job_id int(11) unsigned not null auto_increment,
	job_title varchar(255) null default '',	
	job_deadline varchar(250) not null,
	job_description text default null,
	jcat_id int(11) unsigned not null,
	
	FOREIGN KEY(jcat_id) REFERENCES b_jobcategory(jcat_id) ON DELETE CASCADE,
	
	PRIMARY KEY (job_id)
)ENGINE=InnoDB;

CREATE TABLE b_subject (
	sub_id int(11) unsigned not null auto_increment,
	sub_name varchar(255) null default '',
	
	PRIMARY KEY (sub_id)
)ENGINE=InnoDB;

CREATE TABLE b_catsubject (
	csub_id int(11) unsigned not null auto_increment,
	cat_id int(11) unsigned not null,
	sub_id int(11) unsigned not null,
	
	FOREIGN KEY(cat_id) REFERENCES b_category(cat_id) ON DELETE CASCADE,
	FOREIGN KEY(sub_id) REFERENCES b_subject(sub_id) ON DELETE CASCADE,
	
	PRIMARY KEY (csub_id)
)ENGINE=InnoDB;

CREATE TABLE b_percentage (
	per_id int(11) unsigned not null auto_increment,
	jcat_id int(11) unsigned not null,
	sub_id int(11) unsigned not null,
	
	percentage int(11) unsigned not null,
	
	FOREIGN KEY(jcat_id) REFERENCES b_jobcategory(jcat_id) ON DELETE CASCADE,
	FOREIGN KEY(sub_id) REFERENCES b_subject(sub_id) ON DELETE CASCADE,
	
	PRIMARY KEY (per_id)
);