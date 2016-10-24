<?php
namespace Edu\Cnm\kdilts\DataDesign;

// require_once("autoload.php");

/**
 * @author Kevin Dilts <kdilts@cnm.edu>
 * @version 1.0.0
 */
class Review {
	//use ValidateDate;

	/** id of the author that wrote this review. Foreign key
	 * @var int $reviewAuthorId
	 */
	private $reviewAuthorId;

	/** id of the product this review is about. Foreign key
	 * @var int $reviewProductId
	 */
	private $reviewProductId;

	/** rating 1 - 5 of the product this review is about.
	 * @var int $reviewRating
	 */
	private $reviewRating;

	/** date that this review was posted
	 * @var \DateTime $reviewDatePosted
	 */
	private $reviewDatePosted;

	/** content of this review
	 * @var string $reviewContent
	 */
	private $reviewContent;

	/**
	 * Review constructor.
	 * @param int $newReviewAuthorId author id of this review
	 * @param int $newReviewProductId product id of this review
	 * @param int $newReviewRating rating 1 - 5 of this review
	 * @param \DateTime $newReviewDatePosted date that this review was posted on
	 * @param string $newReviewContent text content of this review
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function __construct(int $newReviewAuthorId, int $newReviewProductId, int $newReviewRating, \DateTime $newReviewDatePosted, string $newReviewContent) {
		try{
			$this->reviewAuthorId = $newReviewAuthorId;
			$this->reviewProductId = $newReviewProductId;
			$this->reviewRating = $newReviewRating;
			$this->reviewDatePosted = $newReviewDatePosted;
			$this->reviewContent = $newReviewContent;
		} catch(\InvalidArgumentException $invalidArgumentException){
			// rethrow exception to the caller
			throw(new \InvalidArgumentException($invalidArgumentException->getMessage(),0,$invalidArgumentException));
		} catch(\RangeException $rangeException){
			// rethrow exception to the caller
			throw(new \RangeException($rangeException->getMessage(),0,$rangeException));
		} catch(\TypeError $typeError){
			// rethrow exception to the caller
			throw(new \TypeError($typeError->getMessage(),0,$typeError));
		} catch(\Exception $exception){
			// rethrow exception to the caller
			throw(new \Exception($exception->getMessage(),0,$exception));
		}
	}

	/** accessor method for author id
	 * @return int value of author id
	 */
	public function getReviewAuthorId(){
		return $this->reviewAuthorId;
	}

	/** accessor method for product id
	 * @return int value of product id
	 */
	public function getReviewProductId(){
		return $this->reviewProductId;
	}

	/** accessor method for review rating
	 * @return int value of review rating
	 */
	public function getReviewRating(){
		return $this->reviewRating;
	}

	/** accessor method for date posted
	 * @return \DateTime value of date posted
	 */
	public function getReviewDatePosted(){
		return $this->reviewDatePosted;
	}

	/** accessor method for review content
	 * @return string value of review content
	 */
	public function getReviewContent(){
		return $this->reviewContent;
	}

	/** mutator method for author id
	 * @param int $newReviewAuthorId new value of review author id
	 * @throws \RangeException if $newReviewAuthorId is not positive
	 * @throws \TypeError if $newReviewAuthorId is not an integer
	 */
	public function setReviewAuthorId(int $newReviewAuthorId){
		// verify that new id is positive
		if($newReviewAuthorId <= 0){
			throw new \RangeException("review author id not positive");
		}

		// store the review author id
		$this->reviewAuthorId = $newReviewAuthorId;
	}

	/** mutator method for product id
	 * @param int $newReviewProductId new value of review product id
	 * @throws \RangeException if $newReviewProductId is not positive
	 * @throws \TypeError if $newReviewProductId is not an integer
	 */
	public function setReviewProductId(int $newReviewProductId){
		// verify that new id is positive
		if($newReviewProductId <= 0){
			throw new \RangeException("review product id not positive");
		}

		// store the review product id
		$this->reviewProductId = $newReviewProductId;
	}

	/** mutator method for review rating
	 * @param int $newReviewRating new value of review rating
	 * @throws \RangeException if $newReviewRating is not between 1 and 5
	 * @throws \TypeError if $newReviewRating is not an integer
	 */
	public function setReviewRating(int $newReviewRating){
		// verify review rating is between 1 and 5
		if($newReviewRating < 1 || $newReviewRating > 5){
			throw new \RangeException("review rating is not between 1 and 5");
		}

		// store the review rating
		$this->reviewRating = $newReviewRating;
	}

	/** mutator method for date posted
	 * @param \DateTime $newReviewDatePosted new value of review date posted
	 * @throws \InvalidArgumentException if $newReviewDatePosted is not a valid object or string
	 * @throws \RangeException if $newReviewDatePosted is a date that does not exist
	 */
	public function setReviewDatePosted(\DateTime $newReviewDatePosted){
		try {
			//$newReviewDatePosted = self::validateDateTime($newReviewDatePosted);
		} catch(\InvalidArgumentException $invalidArgumentException){
			throw new \InvalidArgumentException($invalidArgumentException->getMessage(), 0, $invalidArgumentException);
		} catch(\RangeException $rangeException){
			throw new \RangeException($rangeException->getMessage(), 0, $rangeException);
		}

		// store the review date posted
		$this->reviewDatePosted = $newReviewDatePosted;
	}

	/** mutator method for review content
	 * @param string $newReviewContent new value of review content
	 * @throws \InvalidArgumentException if $newReviewContent is not a string or insecure
	 * @throws \TypeError if $newReviewContent is not a string
	 */
	public function setReviewContent(string $newReviewContent){
		// verify review content is secure
		$newReviewContent = trim($newReviewContent);
		$newReviewContent = filter_var($newReviewContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newReviewContent) === true){
			throw new \InvalidArgumentException("review content is empty or insecure");
		}

		// store the review content
		$this->reviewContent = $newReviewContent;
	}


	/**
	 * inserts this review into mySQL
	 * @param \PDO $pdo
	 * @throws \PDOException
	 * @throws \TypeError
	 */
	public function insert(\PDO $pdo){
		// enforce reviewId is null - don't insert review that already exists
		/*if($this->reviewId !== null){
			throw new \PDOException("not a new review");
		}

		// create query template
		$query = "INSERT INTO review(reviewAuthorId, reviewProductId, reviewRating, reviewDatePosted, reviewContent) VALUES (:reviewAuthorId, :reviewProductId, :reviewRating, :reviewDatePosted, :reviewContent)";
		$statement = $pdo->prepare($query);

		// bind variables to the placeholders in template
		$parameters = [
			"reviewAuthorId" => $this->reviewAuthorId,
			"reviewProductId" => $this->reviewProductId,
			"reviewRating" => $this->reviewRating,
			"reviewDatePosted" => $this->reviewDatePosted,
			"reviewContent" => $this->reviewContent
		];
		$statement->execute($parameters);

		// update null reviewId with what mySQL just gave us
		$this->reviewId = intval($pdo->lastInsertId());*/
	}

	/**
	 * deletes review from mySQL
	 * @param \PDO $pdo
	 * @throws \PDOException
	 * @throws \TypeError
	 */
	public function delete(\PDO $pdo){
		// enforce reviewId not null - don't delete review that does not exist
		/*if($this->reviewId === null){
			throw new \PDOException("unable to delete review that does not exist");
		}

		// create query template
		$query = "DELETE FROM review WHERE reviewId = :reviewId";
		$statement = $pdo->prepare($query);

		// bind variables to the placeholders in template
		$parameters = ["reviewId" => $this->reviewId];
		$statement->execute($parameters);*/
	}

	/**
	 * updates review in mySQL
	 * @param \PDO $pdo
	 */
	public function update(\PDO $pdo){
		// enforce reviewId not null - don't delete review that does not exist
		/*if($this->reviewId === null){
			throw new \PDOException("unable to update review that does not exist");
		}

		// create query template
		$query = "UPDATE review SET reviewId = :reviewId, reviewName = :reviewName";
		$statement = $pdo->prepare($query);

		// bind variables to placeholder in template
		$parameters = [
			"reviewAuthorId" => $this->reviewAuthorId,
			"reviewProductId" => $this->reviewProductId,
			"reviewRating" => $this->reviewRating,
			"reviewDatePosted" => $this->reviewDatePosted,
			"reviewContent" => $this->reviewContent
		];
		$statement->execute($parameters);*/
	}

	/**
	 * get review by reviewAuthorId
	 * @param \PDO $pdo
	 * @param int $reviewAuthorId
	 * @return Review|null
	 * @throws \PDOException
	 * @throws \TypeError
	 */
	public static function getReviewByAuthorId(\PDO $pdo, int $reviewAuthorId){
		// sanitize id before searching
		if($reviewAuthorId <= 0){
			throw new \PDOException("review id must be positive");
		}

		// create query template
		$query = "SELECT reviewAuthorId, reviewProductId, reviewRating, reviewDatePosted, reviewContent FROM review WHERE reviewAuthorId LIKE :reviewAuthorId";
		$statement = $pdo->prepare($query);

		// bind the review author id to the place holder in the template
		$parameters = ["reviewAuthorId" => $reviewAuthorId];
		$statement->execute($parameters);

		// grab the review from mySQL
		try{
			$review = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$review = new Review(
					$row["reviewAuthorId"],
					$row["reviewProductId"],
					$row["reviewRating"],
					$row["reviewDatePosted"],
					$row["reviewContent"]
				);
			}
		} catch (\Exception $exception){
			// if row couldn't be converted, rethrow it
			throw (new \PDOException($exception->getMessage(), 0, $exception));
		}

		return($review);
	}

	/**
	 * get review by reviewProductId
	 * @param \PDO $pdo
	 * @param int $reviewProductId
	 * @return Review|null
	 * @throws \PDOException
	 * @throws \TypeError
	 */
	public static function getReviewByProductId(\PDO $pdo, int $reviewProductId){
		// sanitize id before searching
		if($reviewProductId <= 0){
			throw new \PDOException("review id must be positive");
		}

		// create query template
		$query = "SELECT reviewAuthorId, reviewProductId, reviewRating, reviewDatePosted, reviewContent FROM review WHERE reviewProductId LIKE :reviewProductId";
		$statement = $pdo->prepare($query);

		// bind the review product id to the place holder in the template
		$parameters = ["reviewProductId" => $reviewProductId];
		$statement->execute($parameters);

		// grab the review from mySQL
		try{
			$review = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$review = new Review(
					$row["reviewAuthorId"],
					$row["reviewProductId"],
					$row["reviewRating"],
					$row["reviewDatePosted"],
					$row["reviewContent"]
				);
			}
		} catch (\Exception $exception){
			// if row couldn't be converted, rethrow it
			throw (new \PDOException($exception->getMessage(), 0, $exception));
		}

		return($review);
	}

	/**
	 * get review by reviewRating
	 * @param \PDO $pdo
	 * @param int $reviewRating
	 * @return Review|null
	 * @throws \PDOException
	 * @throws \TypeError
	 */
	public static function getReviewByRating(\PDO $pdo, int $reviewRating){
		// sanitize id before searching
		if($reviewRating > 0 && $reviewRating < 6){
			throw new \PDOException("review rating must be between 1 and 5 inclusive");
		}

		// create query template
		$query = "SELECT reviewAuthorId, reviewProductId, reviewRating, reviewDatePosted, reviewContent FROM review WHERE reviewRating LIKE :reviewRating";
		$statement = $pdo->prepare($query);

		// bind the review rating to the place holder in the template
		$parameters = ["reviewRating" => $reviewRating];
		$statement->execute($parameters);

		// grab the review from mySQL
		try{
			$review = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$review = new Review(
					$row["reviewAuthorId"],
					$row["reviewProductId"],
					$row["reviewRating"],
					$row["reviewDatePosted"],
					$row["reviewContent"]
				);
			}
		} catch (\Exception $exception){
			// if row couldn't be converted, rethrow it
			throw (new \PDOException($exception->getMessage(), 0, $exception));
		}

		return($review);
	}

	/**
	 * get review by reviewDatePosted
	 * @param \PDO $pdo
	 * @param int $reviewDatePosted
	 * @return Review|null
	 * @throws \PDOException
	 * @throws \TypeError
	 */
	public static function getReviewByDatePosted(\PDO $pdo, int $reviewDatePosted){
		// sanitize date before searching
		//TODO validate the date somehow

		// create query template
		$query = "SELECT reviewAuthorId, reviewProductId, reviewRating, reviewDatePosted, reviewContent FROM review WHERE reviewDatePosted LIKE :reviewDatePosted";
		$statement = $pdo->prepare($query);

		// bind the review date posted to the place holder in the template
		$parameters = ["reviewDatePosted" => $reviewDatePosted];
		$statement->execute($parameters);

		// grab the review from mySQL
		try{
			$review = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$review = new Review(
					$row["reviewAuthorId"],
					$row["reviewProductId"],
					$row["reviewRating"],
					$row["reviewDatePosted"],
					$row["reviewContent"]
				);
			}
		} catch (\Exception $exception){
			// if row couldn't be converted, rethrow it
			throw (new \PDOException($exception->getMessage(), 0, $exception));
		}

		return($review);
	}

	/**
	 * get review by reviewContent
	 * @param \PDO $pdo
	 * @param string $reviewContent
	 * @return Review|null
	 * @throws \PDOException
	 * @throws \TypeError
	 */
	public static function getReviewByContent(\PDO $pdo, string $reviewContent){
		// sanitize date before searching
		$reviewContent = trim($reviewContent);
		$reviewContent = filter_var($reviewContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($reviewContent) === true){
			throw(new \PDOException("review content invalid"));
		}

		// create query template
		$query = "SELECT reviewAuthorId, reviewProductId, reviewRating, reviewDatePosted, reviewContent FROM review WHERE reviewContent LIKE :reviewContent";
		$statement = $pdo->prepare($query);

		// bind the review date posted to the place holder in the template
		$parameters = ["reviewContent" => $reviewContent];
		$statement->execute($parameters);

		// grab the review from mySQL
		try{
			$review = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$review = new Review(
					$row["reviewAuthorId"],
					$row["reviewProductId"],
					$row["reviewRating"],
					$row["reviewDatePosted"],
					$row["reviewContent"]
				);
			}
		} catch (\Exception $exception){
			// if row couldn't be converted, rethrow it
			throw (new \PDOException($exception->getMessage(), 0, $exception));
		}

		return($review);
	}

	/**
	 * returns all reviews
	 * @param \PDO $pdo
	 * @return \SplFixedArray
	 * @throws \PDOException
	 * @throws \TypeError
	 */
	public static function getAllReviews(\PDO $pdo){
		// create query template
		$query = "SELECT reviewAuthorId, reviewProductId, reviewRating, reviewDatePosted, reviewContent FROM review";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build array of reviews
		$reviews = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$review = new Review(
					$row["reviewAuthorId"],
					$row["reviewProductId"],
					$row["reviewRating"],
					$row["reviewDatePosted"],
					$row["reviewContent"]
				);
				$reviews[$reviews->key()] = $review;
				$reviews->next();
			} catch(\Exception $exception) {
				// if row couldn't be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}

		return($reviews);
	}

	/**
	 * formats state variables for JSON serialization
	 * @return array
	 */
	public function jsonSerialize(){
		$fields = get_object_vars($this);
		return $fields;
	}
	
}