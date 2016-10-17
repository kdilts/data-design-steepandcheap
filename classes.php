<?php
namespace Edu\Cnm\kdilts\DataDesign;

// require_once("autoload.php");

/**
 * @author Kevin Dilts <kdilts@cnm.edu>
 * @version 1.0.0
 */
class User {
	/**
	 * id for this User; this is the primary key
	 * @var int $userId
	 */
	private $userId;

	/**
	 * username associated with user account
	 * @var string $userName
	 */
	private $userName;

	/**
	 * hash that encrypts user's password
	 * @var string $userHash
	 */
	private $userHash;

	/**
	 * salt added to user's password before hashing
	 * @var string $userSalt
	 */
	private $userSalt;

	/**
	 * physical address associated with user's account
	 * @var string $userAddress
	 */
	private $userAddress;

	/**
	 * email address associated with user's account
	 * @var string $userEmail
	 */
	private $userEmail;

	/**
	 * User constructor.
	 * @param $newUserId int $newUserId of this user
	 * @param $newUserName string $newUserName id of this user
	 * @param $newUserHash string $newUserHash hash for this user
	 * @param $newUserSalt string $newUserSalt salt for this user
	 * @param $newUserAddress string $newUserAddress physical address for this user
	 * @param $newUserEmail string $newUserEmail email address for this user
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function __construct($newUserId, $newUserName, $newUserHash, $newUserSalt, $newUserAddress, $newUserEmail) {
		try {
			$this->setUserId($newUserId);
			$this->setUserName($newUserName);
			$this->setUserHash($newUserHash);
			$this->setUserSalt($newUserSalt);
			$this->setUserAddress($newUserAddress);
			$this->setUserEmail($newUserEmail);
		} catch(\InvalidArgumentException $invalidArgument){
			// rethrow exception to caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range){
			// rethrow exception to caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError){
			// rethrow exception to caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception){
			// rethrow exception to caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for user id
	 * @return int value of user id
	 */
	public function getUserId(){ return $this->userId; }

	/**
	 * accessor method for user name
	 * @return string value of user name
	 */
	public function getUserName(){ return $this->userName; }

	/**
	 * accessor method for user hash
	 * @return string value of user hash
	 */
	public function getUserHash(){ return $this->userHash; }

	/**
	 * accessor method for user salt
	 * @return string value of user salt
	 */
	public function getUserSalt(){ return $this->userSalt; }

	/**
	 * accessor method for user address
	 * @return string value of user address
	 */
	public function getUserAddress(){ return $this->userAddress; }

	/**
	 * accessor method for user email
	 * @return string value of user email
	 */
	public function getUserEmail(){ return $this->userEmail; }

	/**
	 * mutator method for user id
	 * @param int $newUserId new value of user id
	 * @throws \RangeException if $newUserId is not positive
	 * @throws \TypeError if $newUserId is not an integer
	 */
	public function setUserId($newUserId){
		// verify the user id is positive
		if($newUserId <= 0){
			throw(new \RangeException("user id is not positive"));
		}

		// store the user id
		$this->userId = $newUserId;
	}

	/**
	 * mutator method for user name
	 * @param string $newUserName new value of user name
	 * @throws \InvalidArgumentException if $newUserName is not a string or insecure
	 * @throws \RangeException if $newUserName is > 20 characters
	 * @throws \TypeError if $newUserName is not a string
	 */
	public function setUserName($newUserName){
		// verify that user name is secure
		$newUserName = trim($newUserName);
		$newUserName = filter_var($newUserName, FILTER_SANITIZE_STRING);
		if(empty($newUserName) === true){
			throw(new \InvalidArgumentException("user name is empty or insecure"));
		}

		// verify that user name will fit in the database
		if(strlen($newUserName) > 20){
			throw(new \RangeException("user name too long"));
		}

		// store the user name
		$this->userName = $newUserName;
	}

	/**
	 * mutator method for user hash
	 * @param string $newUserHash new value of user hash
	 * @throws \InvalidArgumentException if $newUserHash is not a string or insecure
	 * @throws \RangeException if $newUserHash is > 80 characters
	 * @throws \TypeError if $newUserHash is not a string
	 */
	public function setUserHash($newUserHash){
		// verify that user hash is secure
		$newUserHash = trim($newUserHash);
		$newUserHash = filter_var($newUserHash, FILTER_SANITIZE_STRING);
		if(empty($newUserHash) === true){
			throw(new \InvalidArgumentException("user hash is empty or insecure"));
		}

		// verify that user hash will fit in the database
		if(strlen($newUserHash) > 80){
			throw(new \RangeException("user hash too long"));
		}

		// store the user hash
		$this->userHash = $newUserHash;
	}

	/**
	 * mutator method for user salt
	 * @param string $newUserSalt new value of user salt
	 * @throws \InvalidArgumentException if $newUserSalt is not a string or insecure
	 * @throws \RangeException if $newUserSalt is > 20 characters
	 * @throws \TypeError if $newUserSalt is not a string
	 */
	public function setUserSalt($newUserSalt){
		// verify that user salt is secure
		$newUserSalt = trim($newUserSalt);
		$newUserSalt = filter_var($newUserSalt, FILTER_SANITIZE_STRING);

		// verify that user salt will fit in the database
		if(strlen($newUserSalt) > 20){
			throw(new \RangeException("user salt too long"));
		}

		// store the user salt
		$this->userSalt = $newUserSalt;
	}

	/**
	 * mutator method for user address
	 * @param string $newUserAddress new value of user address
	 * @throws \InvalidArgumentException if $newUserAddress is not a string or insecure
	 * @throws \RangeException if $newUserAddress is > 1000 characters
	 * @throws \TypeError if $newUserAddress is not a string
	 */
	public function setUserAddress($newUserAddress){
		// verify that user address is secure
		$newUserAddress = trim($newUserAddress);
		$newUserAddress = filter_var($newUserAddress, FILTER_SANITIZE_STRING);

		// verify that user address will fit in the database
		if(strlen($newUserAddress) > 1000){
			throw(new \RangeException("user address too long"));
		}

		// store the user address
		$this->userAddress = $newUserAddress;
	}

	/**
	 * mutator method for user email
	 * @param string $newUserEmail new value of user email
	 * @throws \InvalidArgumentException if $newUserEmail is not a string or insecure
	 * @throws \RangeException if $newUserEmail is > 100 characters
	 * @throws \TypeError if $newUserEmail is not a string
	 */
	public function setUserEmail($newUserEmail){
		// verify that user email is secure
		$newUserEmail = trim($newUserEmail);
		$newUserEmail = filter_var($newUserEmail, FILTER_SANITIZE_STRING);

		// verify that user email will fit in the database
		if(strlen($newUserEmail) > 20){
			throw(new \RangeException("user email too long"));
		}

		// store the user email
		$this->userEmail = $newUserEmail;
	}
}

class Product {
	/**
	 * id for this product. this is the primary key.
	 * @var int $productId
	 */
	private $productId;

	/**
	 * name for this product.
	 * @var string $productName
	 */
	private $productName;

	/**
	 * price for this product.
	 * @var float $productPrice
	 */
	private $productPrice;

	/**
	 * image path for this product.
	 * @var string $productImgPath
	 */
	private $productImgPath;

	/**
	 * product specification text for this product.
	 * @var string $productSpecifications
	 */
	private $productSpecifications;


	/**
	 * Product constructor.
	 * @param int $newProductId id of this product
	 * @param string $newProductName name of this product
	 * @param float $newProductPrice price of this product
	 * @param string $newProductImgPath image path of this product
	 * @param string $newProductSpecifications specification text for this product
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function __construct($newProductId, $newProductName, $newProductPrice, $newProductImgPath, $newProductSpecifications) {
		try {
			$this->setProductId($newProductId);
			$this->setProductName($newProductName);
			$this->setProductPrice($newProductPrice);
			$this->setProductImgPath($newProductImgPath);
			$this->setProductSpecifications($newProductSpecifications);
		} catch(\InvalidArgumentException $invalidArgumentException){
			// rethrow the exception to the caller
			throw (new \InvalidArgumentException($invalidArgumentException->getMessage(),0,$invalidArgumentException));
		} catch(\RangeException $rangeException){
			// rethrow the exception to the caller
			throw (new \RangeException($rangeException->getMessage(),0,$rangeException));
		} catch(\TypeError $typeError){
			// rethrow the exception to the caller
			throw (new \TypeError($typeError->getMessage(),0,$typeError));
		} catch(\Exception $exception){
			// rethrow the exception to the caller
			throw (new \Exception($exception->getMessage(),0,$exception));
		}
	}

	/** accessor method for product id
	 * @return int value of product id
	 */
	public function getProductId(){ return $this->productId; }

	/** accessor method for product name
	 * @return string value of product name
	 */
	public function getProductName(){ return $this->productName; }

	/** accessor method for product price
	 * @return float value of product price
	 */
	public function getProductPrice(){ return $this->productPrice; }

	/** accessor method for product image path
	 * @return string value of product image path
	 */
	public function getProductImgPath(){ return $this->productImgPath; }

	/** accessor method for product specifications
	 * @return string value of product specifications
	 */
	public function getProductSpecifications(){ return $this->productSpecifications; }

	/** mutator method for product id
	 * @param int $newProductId new value of product id
	 * @throws \RangeException if $newProductId is not positive
	 * @throws \TypeError if $newProductId is not an integer
	 */
	public function setProductId($newProductId){
		// verify product id is positive
		if($newProductId <= 0){
			throw(new \RangeException("product id is not positive"));
		}

		// store the product id
		$this->productId = $newProductId;
	}

	/** mutator method for product name
	 * @param string $newProductName new value of product name
	 * @throws \InvalidArgumentException if $newProductName is insecure, or not a string
	 * @throws \RangeException if $newProductName is too long
	 * @throws \TypeError if $newProductName is not a string
	 */
	public function setProductName($newProductName){
		// verify that product name is secure
		$newProductName = trim($newProductName);
		$newProductName = filter_var($newProductName, FILTER_SANITIZE_STRING);
		if(empty($newProductName) === true){
			throw new \InvalidArgumentException("product name is empty or insecure");
		}

		// verify that product name will fit into database
		if(strlen($newProductName) > 20){
			throw(new \RangeException("product name too long"));
		}

		// store the product name
		$this->productName = $newProductName;
	}

	/** mutator method for product price
	 * @param float $newProductPrice
	 * @throws \RangeException if $newProductPrice is not positive
	 * @throws \TypeError if $newProductPrice is not a float
	 */
	public function setProductPrice($newProductPrice){
		// verify product price is positive
		if($newProductPrice <= 0){
			throw(new \RangeException("product price is not positive"));
		}

		// store the product price
		$this->productPrice = $newProductPrice;
	}

	/** mutator method for product image path
	 * @param string $newProductImgPath
	 * @throws \InvalidArgumentException if $newProductImgPath is insecure, or not a string
	 * @throws \RangeException if $newProductImgPath is too long
	 * @throws \TypeError if $newProductImgPath is not a string
	 */
	public function setProductImgPath($newProductImgPath){
		// verify that product name is secure
		$newProductImgPath = trim($newProductImgPath);
		$newProductImgPath = filter_var($newProductImgPath, FILTER_SANITIZE_STRING);
		if(empty($newProductImgPath) === true){
			throw new \InvalidArgumentException("product image path is empty or insecure");
		}

		// verify that product name will fit into database
		if(strlen($newProductImgPath) > 80){
			throw(new \RangeException("product img path too long"));
		}

		// store the product img path
		$this->productImgPath = $newProductImgPath;
	}

	/** mutator method for product specification text
	 * @param string $newProductSpecifications
	 * @throws \InvalidArgumentException if $newProductSpecifications is insecure, or not a string
	 * @throws \RangeException if $newProductSpecifications is too long
	 * @throws \TypeError if $newProductSpecifications is not a string
	 */
	public function setProductSpecifications($newProductSpecifications){
		// verify that product name is secure
		$newProductSpecifications = trim($newProductSpecifications);
		$newProductSpecifications = filter_var($newProductSpecifications, FILTER_SANITIZE_STRING);
		if(empty($newProductSpecifications) === true){
			throw new \InvalidArgumentException("product specification text is empty or insecure");
		}

		// store the product specifications
		$this->productSpecifications = $newProductSpecifications;
	}
}

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
	public function __construct($newReviewAuthorId, $newReviewProductId, $newReviewRating, $newReviewDatePosted, $newReviewContent) {
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
	public function getReviewAuthorId(){ return $this->reviewAuthorId; }

	/** accessor method for product id
	 * @return int value of product id
	 */
	public function getReviewProductId(){ return $this->reviewProductId; }

	/** accessor method for review rating
	 * @return int value of review rating
	 */
	public function getReviewRating(){ return $this->reviewRating; }

	/** accessor method for date posted
	 * @return \DateTime value of date posted
	 */
	public function getReviewDatePosted(){ return $this->reviewDatePosted; }

	/** accessor method for review content
	 * @return string value of review content
	 */
	public function getReviewContent(){ return $this->reviewContent; }

	/** mutator method for author id
	 * @param int $newReviewAuthorId new value of review author id
	 * @throws \RangeException if $newReviewAuthorId is not positive
	 * @throws \TypeError if $newReviewAuthorId is not an integer
	 */
	public function setReviewAuthorId($newReviewAuthorId){
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
	public function setReviewProductId($newReviewProductId){
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
	public function setReviewRating($newReviewRating){
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
	public function setReviewDatePosted($newReviewDatePosted){
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
	public function setReviewContent($newReviewContent){
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