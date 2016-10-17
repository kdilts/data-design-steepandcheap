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
		$newReviewContent = filter_var($newReviewContent, FILTER_SANITIZE_STRING);
		if(empty($newReviewContent) === true){
			throw new \InvalidArgumentException("review content is empty or insecure");
		}

		// store the review content
		$this->reviewContent = $newReviewContent;
	}

}

?>