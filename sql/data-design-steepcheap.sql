DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS review;
DROP TABLE IF EXISTS product;

SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE user(
	userId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userName VARCHAR(20) NOT NULL,
	userHash VARCHAR(80),
	userSalt VARCHAR(20),
	userAddress VARCHAR(1000),
	userEmail VARCHAR(100),
	INDEX (userId),
	PRIMARY KEY(userId)
);

CREATE TABLE review(
	reviewAuthorId INT UNSIGNED NOT NULL,
	reviewProductId INT UNSIGNED NOT NULL,
	reviewRating int UNSIGNED NOT NULL,
	reviewDatePosted DATE NOT NULL,
	reviewContent TEXT NOT NULL,
	INDEX (reviewAuthorId),
	INDEX (reviewProductId),
	FOREIGN KEY(reviewAuthorId) REFERENCES user(userId),
	FOREIGN KEY(reviewProductId) REFERENCES product(productId)
);

CREATE TABLE product(
	productId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	productName VARCHAR(20) NOT NULL,
	productPrice FLOAT NOT NULL,
	productImgPath VARCHAR(80) NOT NULL,
	productSpecifications TEXT NOT NULL,
	INDEX (productId),
	PRIMARY KEY(productId)
);